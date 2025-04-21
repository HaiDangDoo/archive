def file_read(file_name):
    with open(file_name, "r", encoding='utf-8') as f:
        return f.read()

def file_save(file_name, data):
    with open(file_name, 'w', encoding='utf-8') as f:
        f.write(data)

def vigenere_decrypt(text, keyword):
    keyword = keyword.upper()
    text = text.upper()
    len_key = len(keyword)
    result = []
    #key_index = 0

    for i, char in enumerate(text):
        if char.isalpha():
            shift = ord(keyword[i % len_key]) - ord('A')
            decrypted_char = chr((ord(char) - ord('A') - shift) % 26 + ord('A'))
            result.append(decrypted_char)
        else:
            result.append(char)
    return ''.join(result)

text = file_read("vegenere_encrypt.txt")
print("đoạn mã hóa cần giải mã:",text)
keyword = file_read("key.txt")
print("Key:",keyword)
vigenere = vigenere_decrypt(text,keyword)
file_save("vegenere_decrypt.txt", vigenere)
print("Vegenere_decrypt:",file_read("vegenere_decrypt.txt"))