# === move_plu.ps1 ===

# Path to source (Downloads folder)
$source = "$env:USERPROFILE\Downloads\PLU.xls"

# Destination folder on D: drive
$targetFolder = "D:\ExcelFiles"
$target = "$targetFolder\PLU.xls"

# Create destination folder if it doesn't exist
if (-not (Test-Path $targetFolder)) {
    New-Item -Path $targetFolder -ItemType Directory
}

# Move the file if it exists
if (Test-Path $source) {
    Move-Item -Path $source -Destination $target -Force
    Write-Host "✅ PLU.xls moved to D:\ExcelFiles"
} else {
    Write-Host "❌ PLU.xls not found in Downloads folder"
}
