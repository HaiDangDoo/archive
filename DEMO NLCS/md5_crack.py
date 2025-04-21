import struct
import math

def left_rotate(x, n):
    return ((x << n) | (x >> (32 - n))) & 0xFFFFFFFF

def md5_padding(message):
    original_byte_len = len(message)
    original_bit_len = original_byte_len * 8
    message += b'\x80'
    while (len(message) % 64) != 56:
        message += b'\x00'
    message += struct.pack('<Q', original_bit_len)
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

# ====== PHẦN SO SÁNH PASSWORD ======
def check_passwords(password_file, hash_file):
    try:
        with open(hash_file, 'r') as hf:
            target_hashes = [line.strip().lower() for line in hf.readlines()]

        with open(password_file, 'r', encoding='utf-8') as pf:
            for line in pf:
                password = line.strip()
                hashed = md5(password.encode())
                if hashed in target_hashes:
                    print(f"[+] Tìm thấy mật khẩu: {password} -> {hashed}")
    except FileNotFoundError:
        print("[!] Không tìm thấy tệp. Kiểm tra lại đường dẫn.")

# ===== CHẠY CHƯƠNG TRÌNH =====
if __name__ == "__main__":
    password_file = input("Nhập đường dẫn tệp password.txt: ")
    hash_file = input("Nhập đường dẫn tệp hash.txt: ")
    check_passwords(password_file, hash_file)
