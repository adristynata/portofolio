import os
import sys
import numpy as np
from PIL import Image
from skimage.measure import find_contours, approximate_polygon

def generate_logo_assets():
    source_img_path = r"C:/Users/HP/.gemini/antigravity/brain/6bf72fed-fa15-4ec7-8cd6-5851ae7bc763/.user_uploaded/media_1792508446223_ab1b7554.jpg"
    print(f"Reading source: {source_img_path}")
    orig = Image.open(source_img_path).convert("RGB")
    W_orig, H_orig = orig.size

    # 1. Add pad to original to avoid border artifacts
    pad = 24
    padded_orig = Image.new("RGB", (W_orig + 2 * pad, H_orig + 2 * pad), (255, 255, 255))
    padded_orig.paste(orig, (pad, pad))

    # 2. Upscale with high-quality Lanczos interpolation to 2048 height
    scale = 2048.0 / padded_orig.height
    target_w = int(round(padded_orig.width * scale))
    target_h = 2048
    hd_rgb = padded_orig.resize((target_w, target_h), Image.Resampling.LANCZOS)

    arr = np.array(hd_rgb, dtype=np.float64)
    H, W, _ = arr.shape

    # 3. Distance from pure white
    dist = np.linalg.norm(255.0 - arr, axis=2)

    # Circle parameters in upscaled canvas
    cx = (397.0 + pad) * scale
    cy = (41.0 + pad) * scale
    r = 41.0 * scale

    ys, xs = np.indices((H, W))
    dot_dist_center = np.sqrt((xs - cx)**2 + (ys - cy)**2)

    # Alpha body transition with smoothstep
    alpha_body = np.clip((dist - 8.0) / 30.0, 0.0, 1.0)
    alpha_body = alpha_body * alpha_body * (3.0 - 2.0 * alpha_body)
    alpha_body[dist > 50.0] = 1.0

    # Alpha dot transition
    dot_band = np.clip((r + 1.5 - dot_dist_center) / 3.0, 0.0, 1.0)
    dot_band = dot_band * dot_band * (3.0 - 2.0 * dot_band)

    # Combine alpha
    is_dot_region = (ys < (cy + r + 20)) & (xs > (cx - r - 25))
    final_alpha = np.where(is_dot_region, dot_band, alpha_body)

    # 4. Color defringing (un-premultiply white background)
    alpha_safe = np.maximum(final_alpha[:, :, None], 0.02)
    c_fg = (arr - (1.0 - final_alpha[:, :, None]) * 255.0) / alpha_safe
    c_fg = np.clip(c_fg, 0.0, 255.0)

    rgba = np.dstack([c_fg, final_alpha * 255.0]).astype(np.uint8)
    hd_img = Image.fromarray(rgba, "RGBA")

    # 5. Fit onto centered square canvas 2048x2048
    bbox = hd_img.getbbox()
    cropped = hd_img.crop(bbox)

    square_size = 2048
    target_dim = int(square_size * 0.86)  # 86% fill with balanced 7% margin
    max_dim = max(cropped.width, cropped.height)
    ratio = target_dim / max_dim
    fitted_w = int(round(cropped.width * ratio))
    fitted_h = int(round(cropped.height * ratio))
    fitted = cropped.resize((fitted_w, fitted_h), Image.Resampling.LANCZOS)

    master_hd = Image.new("RGBA", (square_size, square_size), (0, 0, 0, 0))
    offset_x = (square_size - fitted_w) // 2
    offset_y = (square_size - fitted_h) // 2
    master_hd.paste(fitted, (offset_x, offset_y), fitted)

    # 6. Smooth rounded caps for any clipped ends
    arr_master = np.array(master_hd, dtype=np.float64)
    ys, xs = np.indices((square_size, square_size))

    # Apply caps
    # Bottom loop cap: (609.5, 1900), rx=40.5
    dist_b_loop = np.sqrt(((xs - 609.5)/40.5)**2 + ((ys - 1900.0)/40.5)**2)
    mask_b_loop = (dist_b_loop <= 1.0) & (ys >= 1900)
    color_b_loop = np.array([29.0, 78.0, 216.0, 255.0])

    dist_b_leg = np.sqrt(((xs - 1708.0)/11.0)**2 + ((ys - 1900.0)/11.0)**2)
    mask_b_leg = (dist_b_leg <= 1.0) & (ys >= 1900)
    color_b_leg = np.array([29.0, 78.0, 216.0, 255.0])

    dist_l_loop = np.sqrt(((xs - 195.0)/23.5)**2 + ((ys - 1462.5)/23.5)**2)
    mask_l_loop = (dist_l_loop <= 1.0) & (xs <= 195)
    color_l_loop = np.array([37.0, 99.0, 235.0, 255.0])

    for mask, dist_fn, color in [
        (mask_b_loop, dist_b_loop, color_b_loop),
        (mask_b_leg, dist_b_leg, color_b_leg),
        (mask_l_loop, dist_l_loop, color_l_loop),
    ]:
        alpha_edge = np.clip((1.0 - dist_fn) * 40.0 + 0.5, 0.0, 1.0)
        for c in range(3):
            arr_master[:, :, c] = np.where(mask, color[c], arr_master[:, :, c])
        arr_master[:, :, 3] = np.where(mask, np.maximum(arr_master[:, :, 3], alpha_edge * 255.0), arr_master[:, :, 3])

    # 6b. Apply Bright Electric Cyan-to-Blue Colors to ensure high visibility on dark theme!
    alpha_mask = arr_master[:, :, 3]
    # Projection parameter t along gradient axis (top-right to bottom-left)
    t = ((xs - 1600.0) * (-1200.0) + (ys - 300.0) * 1600.0) / (1200.0**2 + 1600.0**2)
    t = np.clip(t, 0.0, 1.0)

    # Gradient stops:
    # 0.0: #38bdf8 [56, 189, 248]
    # 0.35: #0ea5e9 [14, 165, 233]
    # 0.70: #2563eb [37, 99, 235]
    # 1.0: #1d4ed8 [29, 78, 216]
    c0 = np.array([56.0, 189.0, 248.0])
    c1 = np.array([14.0, 165.0, 233.0])
    c2 = np.array([37.0, 99.0, 235.0])
    c3 = np.array([29.0, 78.0, 216.0])

    body_rgb = np.zeros((square_size, square_size, 3))
    for i in range(3):
        cond1 = t < 0.35
        cond2 = (t >= 0.35) & (t < 0.70)
        t1 = t / 0.35
        t2 = (t - 0.35) / 0.35
        t3 = (t - 0.70) / 0.30
        val = np.where(cond1, c0[i] * (1.0 - t1) + c1[i] * t1,
              np.where(cond2, c1[i] * (1.0 - t2) + c2[i] * t2,
                              c2[i] * (1.0 - t3) + c3[i] * t3))
        body_rgb[:, :, i] = val

    # Dot sphere (radial gradient)
    cx_dot, cy_dot, r_dot = 1631.5, 292.1, 147.8
    dot_dist = np.sqrt((xs - cx_dot)**2 + (ys - cy_dot)**2)
    is_dot = dot_dist <= (r_dot + 15.0)

    hx, hy = cx_dot + 0.3 * r_dot, cy_dot - 0.35 * r_dot
    dist_hl = np.sqrt((xs - hx)**2 + (ys - hy)**2) / (1.5 * r_dot)
    dist_hl = np.clip(dist_hl, 0.0, 1.0)

    # Dot colors:
    # 0.0: #ffffff
    # 0.4: #7dd3fc [125, 211, 252]
    # 1.0: #0284c7 [2, 132, 199]
    dot_rgb = np.zeros((square_size, square_size, 3))
    dc0 = np.array([255.0, 255.0, 255.0])
    dc1 = np.array([125.0, 211.0, 252.0])
    dc2 = np.array([2.0, 132.0, 199.0])
    for i in range(3):
        cond = dist_hl < 0.45
        td1 = dist_hl / 0.45
        td2 = (dist_hl - 0.45) / 0.55
        val = np.where(cond, dc0[i] * (1.0 - td1) + dc1[i] * td1,
                             dc1[i] * (1.0 - td2) + dc2[i] * td2)
        dot_rgb[:, :, i] = val

    final_rgb = np.where(is_dot[:, :, None], dot_rgb, body_rgb)
    arr_master[:, :, :3] = final_rgb

    master_hd = Image.fromarray(arr_master.astype(np.uint8), "RGBA")

    # 7. Save outputs
    os.makedirs("public/images", exist_ok=True)
    os.makedirs("public", exist_ok=True)

    # Master HD 2048x2048
    hd_path = "public/images/logo_hd.png"
    master_hd.save(hd_path, "PNG", optimize=True)
    print(f"Saved: {hd_path} (2048x2048)")

    # Standard 1024x1024
    logo_1024 = master_hd.resize((1024, 1024), Image.Resampling.LANCZOS)
    logo_1024_path = "public/images/logo.png"
    logo_1024.save(logo_1024_path, "PNG", optimize=True)
    print(f"Saved: {logo_1024_path} (1024x1024)")

    # Favicon 512x512
    fav_512 = master_hd.resize((512, 512), Image.Resampling.LANCZOS)
    fav_512_path = "public/favicon.png"
    fav_512.save(fav_512_path, "PNG", optimize=True)
    print(f"Saved: {fav_512_path} (512x512)")

    # Favicon 32x32
    fav_32 = master_hd.resize((32, 32), Image.Resampling.LANCZOS)
    fav_32_path = "public/favicon-32x32.png"
    fav_32.save(fav_32_path, "PNG", optimize=True)
    print(f"Saved: {fav_32_path} (32x32)")

    # Favicon 16x16
    fav_16 = master_hd.resize((16, 16), Image.Resampling.LANCZOS)
    fav_16_path = "public/favicon-16x16.png"
    fav_16.save(fav_16_path, "PNG", optimize=True)
    print(f"Saved: {fav_16_path} (16x16)")

    # Favicon ICO with multiple sizes [16, 32, 48, 64]
    ico_path = "public/favicon.ico"
    master_hd.save(ico_path, format="ICO", sizes=[(16, 16), (32, 32), (48, 48), (64, 64)])
    print(f"Saved: {ico_path}")

    # 8. Vector SVG generation
    alpha_master = np.array(master_hd)[:, :, 3]
    scale_svg = 512.0 / 2048.0
    contours = find_contours(alpha_master, level=128)

    def contour_to_svg_d(c):
        c_scaled = c * scale_svg
        c_simp = approximate_polygon(c_scaled, tolerance=0.35)
        d = f"M {c_simp[0, 1]:.2f} {c_simp[0, 0]:.2f}"
        for pt in c_simp[1:]:
            d += f" L {pt[1]:.2f} {pt[0]:.2f}"
        d += " Z"
        return d

    body_c = None
    leg_c = None
    for c in contours:
        c_scaled = c * scale_svg
        mean_y = c_scaled[:, 0].mean()
        mean_x = c_scaled[:, 1].mean()
        if mean_y < 120 and mean_x > 350:
            continue
        elif len(c) > 5000:
            body_c = c
        else:
            leg_c = c

    d_body = contour_to_svg_d(body_c)
    d_leg = contour_to_svg_d(leg_c)
    dot_cx = 1631.5 * scale_svg
    dot_cy = 292.1 * scale_svg
    dot_r = 147.8 * scale_svg

    svg_content = f"""<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="100%" height="100%">
  <defs>
    <!-- Bright Electric Cyan-to-Blue Gradient (Vividly visible on both dark and light modes) -->
    <linearGradient id="logoBodyGrad" x1="75%" y1="15%" x2="25%" y2="85%">
      <stop offset="0%" stop-color="#38bdf8"/>
      <stop offset="35%" stop-color="#0ea5e9"/>
      <stop offset="70%" stop-color="#2563eb"/>
      <stop offset="100%" stop-color="#1d4ed8"/>
    </linearGradient>

    <!-- 3D Luminous Dot Sphere Radial Gradient -->
    <radialGradient id="logoDotGrad" cx="68%" cy="28%" r="68%">
      <stop offset="0%" stop-color="#ffffff"/>
      <stop offset="25%" stop-color="#e0f2fe"/>
      <stop offset="60%" stop-color="#7dd3fc"/>
      <stop offset="85%" stop-color="#38bdf8"/>
      <stop offset="100%" stop-color="#0284c7"/>
    </radialGradient>
  </defs>

  <!-- Main Loop and Stem (Evenodd handles inner counter hole) -->
  <path d="{d_body}" fill="url(#logoBodyGrad)" fill-rule="evenodd"/>

  <!-- Bottom-Right Leg -->
  <path d="{d_leg}" fill="url(#logoBodyGrad)"/>

  <!-- Top-Right 3D Dot Sphere -->
  <circle cx="{dot_cx:.2f}" cy="{dot_cy:.2f}" r="{dot_r:.2f}" fill="url(#logoDotGrad)"/>
</svg>
"""

    with open("public/images/logo.svg", "w", encoding="utf-8") as f:
        f.write(svg_content)
    print("Saved: public/images/logo.svg")

    with open("public/favicon.svg", "w", encoding="utf-8") as f:
        f.write(svg_content)
    print("Saved: public/favicon.svg")

    # Also save to artifact directory for easy download
    artifact_dir = r"C:/Users/HP/.gemini/antigravity/brain/6bf72fed-fa15-4ec7-8cd6-5851ae7bc763"
    master_hd.save(os.path.join(artifact_dir, "logo_hd_transparent.png"), "PNG")
    with open(os.path.join(artifact_dir, "logo_vector.svg"), "w", encoding="utf-8") as f:
        f.write(svg_content)
    print("Saved logo to artifact directory.")

if __name__ == "__main__":
    generate_logo_assets()
