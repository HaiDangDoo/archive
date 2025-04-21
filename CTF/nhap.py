chuoi = [16,9,3,15,3,20,6,20,8,5,14,21,13,2,5,18,19,13,1,19,15,14]

for i in range(26):
    characters = ''.join(chr(code+60+i) for code in chuoi)
    print("\n",i,characters)
# Output: Hello