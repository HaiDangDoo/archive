import hashlib

def hash_md5_from_string(data):
    # Chuyển đổi chuỗi thành bytes
    byte_data = data.encode('utf-8')
    # Tính hash MD5
    md5_hash = hashlib.md5(byte_data)
    return md5_hash.hexdigest()

# Ví dụ
data = "haidang21082003#"
print(f"MD5 hash của chuỗi '{data}': {hash_md5_from_string(data)}")
