import json
import os

log_path = r'C:\Users\91870\.gemini\antigravity\brain\2554ded4-4391-4aa8-9eca-99fb723b16e7\.system_generated\logs\overview.txt'
with open(log_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

# Search for scholarship.php content in early turns
for line in lines[:50]:
    try:
        data = json.loads(line)
        if 'content' in data and 'id="emrs-content"' in data['content']:
            print("Found in Turn " + str(data.get('step_index')))
            # Extract content around emrs-content
            start = data['content'].find('id="emrs-content"')
            print(data['content'][start:start+2000])
            break
    except:
        continue
