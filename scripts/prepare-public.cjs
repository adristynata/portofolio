const fs = require('fs');
const path = require('path');

const projectRoot = path.resolve(__dirname, '..');
const storageSrc = path.join(projectRoot, 'storage', 'app', 'public');
const storageDest = path.join(projectRoot, 'public', 'storage');
const publicDir = path.join(projectRoot, 'public');
const distDir = path.join(projectRoot, 'dist');

try {
    if (fs.existsSync(storageSrc)) {
        if (!fs.existsSync(storageDest)) {
            console.log('Copying storage/app/public to public/storage...');
            fs.cpSync(storageSrc, storageDest, { recursive: true });
        } else {
            const realSrc = fs.realpathSync(storageSrc);
            const realDest = fs.realpathSync(storageDest);
            if (realSrc !== realDest) {
                fs.cpSync(storageSrc, storageDest, { recursive: true, force: false });
            }
        }
    }
} catch (err) {
    console.warn('Storage sync notice:', err.message);
}

try {
    if (fs.existsSync(publicDir)) {
        if (fs.existsSync(distDir)) {
            fs.rmSync(distDir, { recursive: true, force: true });
        }
        console.log('Mirroring public to dist for Vercel...');
        fs.cpSync(publicDir, distDir, { recursive: true });
        console.log('Successfully prepared public and dist.');
    }
} catch (err) {
    console.warn('Dist sync notice:', err.message);
}
