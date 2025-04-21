import struct
import math

def left_rotate(x, n):
    return ((x << n) | (x >> (32 - n))) & 0xFFFFFFFF

def md5_padding(message):
    original_byte_len = len(message)
    original_bit_len = original_byte_len * 8
    message += b'\x80'  # Append a single '1' bit (10000000 in binary)
    while (len(message) % 64) != 56:
        message += b'\x00'  # Padding with zeros until length is 56 mod 64
    message += struct.pack('<Q', original_bit_len)  # Append original length in bits (little-endian)
    return message

def md5(message):
    A, B, C, D = 0x67452301, 0xEFCDAB89, 0x98BADCFE, 0x10325476
    S = [
        [7, 12, 17, 22],
        [5, 9, 14, 20],
        [4, 11, 16, 23],
        [6, 10, 15, 21]
    ]
    T = [int(2**32 * abs(math.sin(i + 1))) & 0xFFFFFFFF for i in range(64)]
    
    def F(x, y, z): return (x & y) | (~x & z)
    def G(x, y, z): return (x & z) | (y & ~z)
    def H(x, y, z): return x ^ y ^ z
    def I(x, y, z): return y ^ (x | ~z)
    
    message = md5_padding(message)
    
    a, b, c, d = A, B, C, D
    
    for i in range(0, len(message), 64):
        chunk = message[i:i + 64]
        X = struct.unpack('<16I', chunk)
        aa, bb, cc, dd = a, b, c, d
        
        for i in range(64):
            if i < 16:
                f, g = F(b, c, d), i
            elif i < 32:
                f, g = G(b, c, d), (5 * i + 1) % 16
            elif i < 48:
                f, g = H(b, c, d), (3 * i + 5) % 16
            else:
                f, g = I(b, c, d), (7 * i) % 16
            
            f = (f + a + T[i] + X[g]) & 0xFFFFFFFF
            a, d, c, b = d, c, b, (b + left_rotate(f, S[i // 16][i % 4])) & 0xFFFFFFFF
        
        a = (a + aa) & 0xFFFFFFFF
        b = (b + bb) & 0xFFFFFFFF
        c = (c + cc) & 0xFFFFFFFF
        d = (d + dd) & 0xFFFFFFFF
    
    return struct.pack('<4I', a, b, c, d).hex()

# Nhập chuỗi để băm
input_string = input("Nhập chuỗi cần băm: ")
hashed_value = md5(input_string.encode())
print("MD5 hash value:", hashed_value)
