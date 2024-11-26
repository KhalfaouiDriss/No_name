# archive.py
import sys
import os
import zipfile

def create_zip(folder_path, output_zip_path):
    with zipfile.ZipFile(output_zip_path, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(folder_path):
            for file in files:
                file_path = os.path.join(root, file)
                arcname = os.path.relpath(file_path, folder_path)
                zipf.write(file_path, arcname)
    print(f"Archived {folder_path} to {output_zip_path}")

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python archive.py <folder_path> <output_zip_path>")
        sys.exit(1)

    folder_path = sys.argv[1]
    output_zip_path = sys.argv[2]

    create_zip(folder_path, output_zip_path)
