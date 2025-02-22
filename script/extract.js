const extract = require("extract-zip");
const path = require("path");
const fs = require("fs");

async function unzipFile() {
  const zipFilePath = path.join(__dirname, "fpdf186.zip"); // Replace with your ZIP file name
  const outputDir = path.join(__dirname, "extracted");

  try {
    // Ensure output directory exists
    if (!fs.existsSync(outputDir)) {
      fs.mkdirSync(outputDir, { recursive: true });
    }

    console.log("Extracting ZIP file...");
    await extract(zipFilePath, { dir: outputDir });
    console.log("ZIP extracted successfully!");
  } catch (err) {
    console.error("Error extracting ZIP:", err);
  }
}

// Run the function
unzipFile();
