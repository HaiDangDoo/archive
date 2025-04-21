print("---------------***--------------")
print("----------Hack Caesar-----------")
print("-----------Cach 1----------------")
#đọc file
def file_read(file_name):
    with open(file_name,'r') as file:
        data = file.read()
    return data
text = file_read('crypto_file_save.txt')
#giải mã Caesar
def giai_ma(text, k):
    result = ""
    for i in range(len(text)):
        char = text[i]
        if(char.isupper()):
            result += chr((ord(char) - 65 - k)%26 + 65)
        elif (97 <= (ord(char)) <= 122):
            result += chr((ord(char) - 97 - k)%26 + 97)
        else :
             result += text[i]
    return result
k = int(13)# khóa k
#lưu mã hóa
def text_save(file_name, text):
  with open(file_name, 'w') as file:
    file.write("\n")
    file.write(text)
file_name = "giai_ma.txt"
new_line = giai_ma(text,k)
#text save
text_save(file_name, new_line)
#read file crypto_file_save.txt
file_name = "giai_ma.txt"
content = file_read(file_name)
print("Dữ liệu cần giải mã:\n",text)
print("khóa: ", k)
print("Dữ liệu được giải mã thành:\n",content)