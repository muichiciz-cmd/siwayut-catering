import os
import re

with open('.context/BRIEF.md', 'r') as f:
    lines = f.read().split('\n')

in_block = False
current_file = None
current_content = []

for i, line in enumerate(lines):
    if line.startswith('```') and not in_block:
        in_block = True
        current_content = []
        # Check if preceded by "File: <name>"
        if i > 1 and lines[i-1].strip() == '' and lines[i-2].startswith('File: '):
            current_file = lines[i-2].split('File: ')[1].strip()
        elif i > 0 and lines[i-1].startswith('File: '):
            current_file = lines[i-1].split('File: ')[1].strip()
    elif line.startswith('```') and in_block:
        in_block = False
        if current_file and current_file not in ['path/to/file.php', 'path']:
            os.makedirs(os.path.dirname(current_file) or '.', exist_ok=True)
            with open(current_file, 'w') as out:
                out.write('\n'.join(current_content) + '\n')
            print(f"Created {current_file}")
        current_file = None
    elif in_block:
        current_content.append(line)
        m = re.search(r'^(?://|#|/\*|<!--|--)\s*File:\s*(.+?)(?:\s*\*/|\s*-->)?$', line)
        if m and not current_file:
            current_file = m.group(1).strip()

os.makedirs('storage/logs', exist_ok=True)
with open('storage/logs/.gitkeep', 'w') as f:
    pass
os.makedirs('storage/uploads', exist_ok=True)
with open('storage/uploads/.gitkeep', 'w') as f:
    pass

print("Done!")
