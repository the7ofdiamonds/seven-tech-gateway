const fs = require('fs');
const crypto = require('crypto');

module.exports = function generateIndexAssetPHPFile() {
  return {
    name: 'generate-index-assets-php',
    writeBundle(options, bundle) {
      const mainBundleName = 'src/index.jsx';

      // Check if the main bundle exists in the bundle object
      if (bundle[mainBundleName]) {
        // Extracting the content of the main bundle
        const mainBundleContent = bundle[mainBundleName].code;

        // Generating a hash based on the content
        const hash = crypto.createHash('md5').update(mainBundleContent).digest('hex');

        const content = `<?php return array('dependencies' => array('react', 'react-dom'), 'version' => '${hash}');`;
        fs.writeFileSync('Assets/JS/dist/index.assets.php', content);
      } else {
        console.error(`Main bundle '${mainBundleName}' not found in the bundle object.`);
      }
    },
  };
};
