from Crypto.Hash import MD4

def ntlm_hash(password: str) -> str:
    password_utf16 = password.encode('utf-16le')
    md4_hash = MD4.new(password_utf16).digest()
    return md4_hash.hex()

password = "mypassword"
ntlm = ntlm_hash(password)
print(f"NTLM hash của '{password}' là: {ntlm}")
