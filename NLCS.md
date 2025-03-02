# | Niên Luận Cơ Sở An Toàn Thông Tin -Một Số Hình Thức Tấn Công Mạng- Lê Hải Đăng - B2203716

---

# A -  PASSWORD ATTACK - HASH CRACKING

## I.  PASSWORD ATTACK - HASH CRACKING

<aside>
🪶

- Mục tiêu:
    - Hàm băm và giá trị băm.
    - Lưu mật khẩu đã băm.
    - Bẻ khóa băm.
    - Tìm mật khẩu của một tài liệu được bảo vệ bằng mật khẩu.
</aside>

### 1. Mở Đầu.

1. **Hashed Passwords.**

Trước khi đi sâu hơn, sẽ rất hữu ích nếu tìm hiểu cách lưu mật khẩu trong các hệ thống xác thực. Cách đây rất lâu, trước khi bảo mật trở thành một "thứ gì đó", mật khẩu được lưu trữ dưới dạng văn bản thuần túy cùng với tên người dùng được liên kết. Khi người dùng cố gắng đăng nhập, hệ thống sẽ so sánh mật khẩu được cung cấp cho tài khoản này với mật khẩu đã lưu. Do đó, nếu người dùng quên mật khẩu, một người nào đó có đủ quyền truy cập có thể xem bảng (VD quản trị viên hay quản trị hệ thống) và tìm kiếm bằng một câu đại loại như "Mật khẩu cho `joebloggs`là `ASDF1234`." Đây là một ý tưởng tồi, đặc biệt là vì cơ sở dữ liệu có thể bị đánh cắp và nội dung của nó bị rò rỉ trực tuyến. Thật không may, người dùng có xu hướng sử dụng cùng một mật khẩu cho các dịch vụ khác nhau. Do đó, nếu kẻ thù phát hiện ra mật khẩu của Joe Bloggs từ một dịch vụ khác, chúng sẽ thử mật khẩu đó trên các tài khoản khác của Joe, chẳng hạn như email.

Để bảo vệ mật khẩu, ngay cả trong trường hợp vi phạm dữ liệu, các công ty bắt đầu lưu phiên bản băm của mật khẩu. Đối với điều đó, chúng ta cần sử dụng hàm băm. Hàm băm lấy đầu vào có bất kỳ kích thước nào và trả về giá trị kích thước cố định. Ví dụ: SHA256 (Thuật toán băm an toàn 256) tạo ra giá trị băm 256 bit. Nói cách khác, `sha256sum FILE_NAME`sẽ trả về giá trị băm 256 bit bất kể tệp đầu vào là vài byte hay vài gigabyte. 

Do đó, thay vì lưu mật khẩu `ASDF1234`nguyên văn, hàm băm của nó được lưu. Ví dụ, nếu MD5 (Message Digest 5) được sử dụng, thì `ce1bccda287f1d9e6d80dbd4cb6beb60`(hash value của ASDF123) sẽ được lưu. Vấn đề đã được giải quyết? Không hẳn vậy. Đầu tiên, MD5 hiện được coi là không an toàn. Thứ hai, ngoài việc chọn hàm băm an toàn, chúng ta nên thêm một **salt** , tức là *một chuỗi ký tự ngẫu nhiên* , vào mật khẩu trước khi băm nó. Nói cách khác, thay vì lưu `hash(password)`trong bảng, chúng ta lưu `hash(password + salt)`cùng với salt. Do đó, khi người dùng cố gắng đăng nhập, hệ thống xác thực sẽ lấy mật khẩu của họ cùng với salt đã lưu, tính toán hàm băm của nó và so sánh với giá trị băm đã lưu; nếu giống hệt nhau, họ sẽ được cấp quyền truy cập. Điều này làm cho các mật khẩu đã lưu miễn nhiễm hơn với nhiều loại tấn công.

1. **Password-Protected Files.**
- Các file có thể là văn bản, ảnh, video, âm thanh…

Về mặt kỹ thuật, chúng ta có thể bảo vệ tính bảo mật và toàn vẹn của **dữ liệu trong quá trình truyền tải** . Hôm nay, chúng ta sẽ khám phá cách xem tài liệu được bảo vệ bằng mật khẩu. Về mặt kỹ thuật, chúng ta sẽ tấn công vào tính bảo mật của dữ **liệu khi không hoạt động**.

Một khía cạnh của bảo mật yêu cầu chúng ta phải bảo vệ dữ liệu trong khi dữ liệu được lưu trữ trên bất kỳ thiết bị lưu trữ nào; ví dụ bao gồm ổ đĩa flash, bộ nhớ điện thoại thông minh, bộ nhớ máy tính xách tay và ổ đĩa ngoài. Nếu kẻ thù có quyền truy cập vào bất kỳ thiết bị nào như vậy, chúng tôi không muốn chúng có thể truy cập vào các tệp của chúng tôi. Bảo vệ dữ liệu khi không hoạt động thường đạt được bằng cách mã hóa toàn bộ đĩa hoặc các tệp cụ thể trên đĩa.

- Chúng ta chỉ bàn về khía cạnh lưu trữ dữ liệu nội bộ, không phải dữ liệu truyền ra ngoài internet.

khác với chứng thực người dùng bằng mật khẩu, khi chứng thực người dùng bằng mật khẩu ta cần hash[password] vào CSDL, khi người dùng đăng nhập vào tài khoảng cần so sánh hash[password] người dùng mới nhập vào và hash đã lưu. Decrtption thì không cần lưu trữ key để so sánh vậy chúng ta cần băm mật khẩu làm gì?

**Lý do hash được sử dụng trong trường hợp này:** Để thuận tiện hơn cho người sử dụng.

- Ví dụ, khi hệ thống sử dụng hệ mã hóa đối xứng AES-256 để lưu trữ dữ liệu nội bộ, chúng ta cần khóa có độ dài 256 bit (32 ký tự trong bản mã ASSCII) để mã hóa và giải mã tài liệu.
    - Khi cần truy cập tài liệu bạn phải rõ chính xác 32 ký tự không được thừa cũng không được thiếu.
    - Thời gian rõ 32 ký tự rất lâu.
    - Khi lỡ sai phải rõ lại mật khẩu dài ngoằn rất bực mình.
    - Mật khẩu quá dài rất khó nhớ đặc biệt là người lớn tủi và người dùng thông thường.
        
        → Bất tiện cho người sử dụng.
        
    
    ⇒ Chúng ta có thể sử dụng hàm băm để băm mật khẩu có độ dài bất kỳ làm khóa cho giải thuật(VD như SHA-256).
    
    - Mật khẩu có độ dài bất kỳ → khóa(256 bit)
    - tiết kiệm thời gian rõ mật khẩu.
    - có thể đặt mật khẩu dễ nhớ.
    - Tiện lợi cho người dùng mà vẫn dữ được tài liệu an toàn.

### 2. Password là gì.

Password là một chuỗi tổ hợp các ký tự có độ dài giới hạn, được sử dụng để xác thực quyền truy cập vào hệ thống kỹ thuật số.

Dù hiện tại thế giới có rất nhiều phương thức xác thực mới, như sinh trắc học, chữ ký số,...tuy nhiên password vẫn là một thứ không thể thay thế ở nhiều hệ thống, hệ điều hành,... hay các giao thức truy nhập, bởi nó đảm bảo được 2 điều:

> 1. Bí mật: Chỉ một hoặc rất ít người biết nội dung ( tổ hợp ký tự ) của password được sử dụng.
> 

> 2. Bảo mật: Trên lý thuyết, mọi password đều có thể bị crack. Tuy nhiên để làm được điều đó phải tốn nhiều công sức, đôi khi là cả may mắn, và đôi khi là không thể.
> 

Những phương thức "mới" như vân tay, nhận diện khuôn mặt,...có thể bị làm giả, copy và bị qua mặt. Đơn giản như khi chúng ta ngủ, có người lấy ngón tay chúng ta để "by pass" chính điện thoại của chúng ta. Hay phức tạp hơn là dấu vân tay bị copy và sử dụng vào mục đích xấu. Hay phức tạp hơn nữa là Face ID của Apple bị một chiếc mặt nạ do BKAV làm giả đánh lừa.

Những ví dụ trên đều nói lên sự quan trọng và tính **không thể thay thế hoàn toàn** của password.

### 3.Hashing là gì? Tại sao lại hashing password?

Password hashing chắc hẳn không hề lạ lẫm với một số bạn dev. Ngôn ngữ nào cũng có, ứng dụng nào cũng có. Hễ có người dùng ắt sẽ có password, hễ có password ắt có mặt hashing.

Hashing là quá trình biến đầu vào là một nội dung có kích thước, độ dài bất kỳ rồi sử dụng những thuật toán, công thức toán học để biến thành đầu ra tiêu chuẩn có độ dài nhất định. Quá trình đó sử dụng những Hàm băm (Hash function).

Khái niệm Hashing hoàn toàn khác với Encrypting bạn nhé.

**Hashing là phương pháp mã hóa một chiều** được sử dụng để đảm bảo tính toàn vẹn của dữ liệu, xác thực thông tin, mật khẩu an toàn và các thông tin nhạy cảm khác. Các hàm băm chuyển đổi dữ liệu thành một chuỗi ký tự có kích thước cố định, đồng nhất và xác định, khiến nó trở thành một lựa chọn tuyệt vời để duy trì tính bảo mật của dữ liệu.

Một trong những tính năng chính liên quan đến lưu trữ mật khẩu là kết quả chỉ có một chiều, nghĩa là có thể thu được kết quả tương tự với cùng dữ liệu đầu vào, nhưng không thể tính toán dữ liệu đầu vào khi biết kết quả, cho phép xác thực thông tin đăng nhập của người dùng mà không cần biết dữ liệu gốc.

![Tính Duy Nhất Và Cố Định Của Hàm Băm](attachment:cc44788b-f381-4f8b-86c3-ca8ccca9f05f:Screenshot_2025-02-21_141513.png)

Tính Duy Nhất Và Cố Định Của Hàm Băm

![Tính Không Thể Đảo Ngược Của Hàm Băm.](attachment:7a4f7b66-94b8-4b1e-932c-20cbbdf66aaf:Screenshot_2025-02-21_141813.png)

Tính Không Thể Đảo Ngược Của Hàm Băm.

- Tóm lại hàm băm có những đặt tính sau:
    - **Có tính xác định**: Cùng một chuỗi đầu vào được xử lý bởi cùng hàm băm, sẽ cho ra cùng một kết quả.
    - **Không thể đảo ngược(một chiều)**: Không thể tạo ra chuỗi (thông điệp) từ một chuỗi đã được băm từ hàm băm.
    - **Có entropy cao**: Khi có một thay đổi nhỏ trong chuỗi thông điệp, sẽ tạo ra chuỗi băm khác nhau (Ví dụ: Abcde và abcde sẽ tạo ra 2 chuỗi băm khác nhau dù chỉ khác ở chữ a).
    - **Có tính duy nhất**: Hai thông điệp khác nhau thì nhận về 2 chuỗi băm khác nhau.
    - **Đầu ra có độ dài cố định**.
    - **Áp dụng trên khối dữ liệu có dộ dài bất kỳ.**

Hàm băm nào đáp ứng đủ 5 thuộc tính (đầu) trên sẽ là một hàm đủ tiêu chuẩn để băm mật khẩu, vì sẽ làm tăng độ khó cho các kỹ thuật đảo ngược mật khẩu. Và thêm nữa, các chuyên gia cũng nói rằng, thuật toán băm phải có độ phức tạp lớn, để hàm băm chậm vì do một khi băm nhanh, sẽ dễ bị hacker lợi dụng để đoán mật khẩu bằng cách băm và so sánh hàng tỷ mật khẩu mỗi ngày.

- Ứng dụng của hàm băm:
    - **Kiểm tra sự toàn vẹn của tệp tin: giá trị băm được xem như là dấu vân tay xác nhận của tệp tin.**
    - Ứng dụng chữ ký số(chữ ký điện tử): kết hợp giữa hàm băm và thuật toán mã hóa bất đối xứng(hashing + [RSA hoặc ECC] có thể kết hợp với cả mã hóa đối xứng).
    - **Xác minh mật khẩu: Điều này làm giảm đáng kể thiệt hại khi cơ sở dữ liệu bị tấn công, khi những gì bị lộ ra ngoài là những giá trị băm chứ không phải mật khẩu của bạn.**
    - HMAC - Hashed Message Authentication Code (Mã chứng thực thông điệp sử dụng hàm băm).
    - Mã hóa dựa trên mật khẩu(PBE): kết hợp giữa hash + decrypt.
- Một số hàm băm phổ biến:
    - MD5 (Không nên dùng): nó đã bị phát hiện ra rằng đã phạm vào "điều lệ thứ 4", 2 chuỗi băm được tạo ra có thể trùng nhau từ 2 thông điệp khác nhau. Và kinh điển hơn nữa, thuật toán này chạy rất nhanh, nên rất dễ bị hacker truy lùng mật khẩu bằng cách thử (nhanh quá cũng mệt thế đấy, chậm cho chắc).
    - SHA-512(Không nên dùng): Vì nó hashing quá nhanh.
    - **PBKDF2, BCrypt, and SCrypt(Được khuyến nghị):Mỗi thuật toán đều chậm, và hơn hết chúng đều có tính năng tuyệt vời là có thể cấu hình cường độ (configurable strength).**
- Để an toàn hơn, hệ thống còn thêm giá trị muối (salt) vào mật khẩu gốc của bạn, rồi cho chạy qua hàm băm, sau đó mới lưu vào cơ sở dữ liệu. Vậy nên kể cả khi giá trị băm của mật khẩu bạn bị lộ và bị giải mã, kẻ tấn công vẫn chưa thể có được mật khẩu thực sự của bạn do nó đã được thêm vào giá trị "salt".

<aside>
🥋

### 4. Nguyên Lý hoạt động của hàm băm:

- **GIẢI THUẬT BĂM MD5:**
    - Input: thông điệp với độ dài bất kỳ.
    - Output: Giá trị băm có độ dài cố định 128bit (16 ký tự trong bản mã ASCII)
    - Giải thuật gồm 5 bước thao tác trên chuỗi khối.
- **Bước 1:** nhồi dữ liệu
    - Nhồi thêm các bits sao cho dữ liệu có độ dài l ≡ 448 mod 512 hay l
    = n * 512 + 448 (n,l nguyên)
    - Luôn thực hiện nhồi dữ liệu ngay cả khi dữ liệu ban đầu có độ dài
    mong muốn. Ví dụ: dữ liệu có độ dài 448 được nhồi thêm 512 bits để
    được độ dài 960 bits.
    - Số lượng bit nhồi thêm nằm trong khoảng 1 đến 512
    - Các bit được nhồi gồm 1 bit “1” và các bit 0 theo sau.

![image.png](attachment:e4c71283-7eca-4255-875d-fb46e800f55a:image.png)

- Bước 2: thêm vào độ dài
    - Độ dài của khối dữ liệu ban đầu được biểu diễn dưới dạng nhị phân
    64-bit và được thêm vào cuối chuỗi nhị phân kết quả của bước 1
    - Nếu độ dài của khối dữ liệu ban đầu > 264, chỉ 64 bits thấp được sử
    dụng, nghĩa là giá trị được thêm vào bằng K mod 264
    - Kết quả có được từ 2 bước đầu là một khối dữ liệu có độ dài là bội
    số của 512. Khối dữ liệu được biểu diễn:
        - Bằng một dãy L khối 512-bit Y0, Y1,…, YL-1
        - Bằng một dãy N từ (word) 32-bit M0, M1, MN-1. Vậy N = L x 16 (32 x 16
        = 512)

![image.png](attachment:61518459-16a4-40f7-84d5-fee71771349d:image.png)

- Bước 3: khởi tạo bộ đệm MD (MD buffer)
    - Một bộ đệm 128-bit được dùng lưu trữ các giá trị băm trung
    gian và kết quả. Bộ đệm được biểu diễn bằng 4 thanh ghi 32-
    bit với các giá trị khởi tạo ở dạng little-endian (byte có trọng
    số nhỏ nhất trong từ nằm ở địa chỉ thấp nhất) như sau:
        - A = 67 45 23 01
        - B = EF CD AB 89
        - C = 98 BA DC FE
        - D = 10 32 54 76
    - Các giá trị này tương đương với các từ 32-bit sau:
        - A = 01 23 45 67
        - B = 89 AB CD EF
        - C = FE DC BA 98
        - D = 76 54 32 10

Bước 4: xử lý các khối dữ liệu 512-
bit

- Trọng tâm của giải thuật là hàm
nén (compression function) gồm 4
“vòng” xử lý. Các vòng này có cấu
trúc giống nhau nhưng sử dụng các
hàm luận lý khác nhau gồm F, G, H
và I
    - F(X,Y,Z) = X ˄ Y ˅ ̚X ˄ Z
    - G(X,Y,Z) = X ˄ Z ˅ Y ˄ ̚Z
    - H(X,Y,Z) = X xor Y xor Z
    - I(X,Y,Z) = Y xor (X ˅ ̚Z)
- Mảng 64 phần tử được tính theo
công thức: T[i] = 232 x abs(sin(i)), i
được tính theo radian.
- Kết quả của 4 vòng được cộng (theo
modulo 232 với đầu vào CVq để tạo
CVq+1

![image.png](attachment:b60eb141-7c71-4acf-96e6-4f735b0f8dfe:image.png)

- Các giá trị trong bảng T:

![image.png](attachment:77142b1c-bfdd-417b-be54-9b9f2fbcdefa:image.png)

- Bước 5: Xuất kết quả
    - Sau khi xử lý hết L khối 512-bit, đầu ra của lần xử lý thứ L là giá trị
    băm 128 bits.
- Giải thuật MD5 được tóm tắt như sau:
    - CV0 = IV
    - CVq+1 = SUM32[CVq,RFI(Yq,RFH(Yq,RFG(Yq,RFF(Yq,CVq))))]
    - MD = CVL-1
- Với các tham số
    - IV: bộ đệm gồm 4 thanh ghi ABCD
    - Yq: khối dữ liệu thứ q gồm 512 bits
    - L: số khối 512-bit sau khi nhồi dữ liệu
    - CVq: đầu ra của khối thứ q sau khi áp dụng hàm nén
    - RFx: hàm luận lý sử dụng trong các “vòng” (F,G,H,I)
    - MD: message digest – giá trị băm
    - SUM 32: cộng modulo 2^32

Hàm nén:

- Mỗi vòng thực hiện 16 bước, mỗi
bước thực hiện các phép toán để
cập nhật giá trị buffer ABCD, mỗi
bước được mô tả như sau
    - A ← B + ((A + F(B,C,D) +X[k] +T[i]) <<< s)
    - A,B,C,D: các từ của thanh ghi
    - F: một trong các hàm F,G,H,I
    - <<< s : dịch vòng trái s bits
    - Mi ~ X[k]: từ 32-bit thứ k của khối dữ liệu 512 bits.k=1..15
    - Ki ~ T[i]: giá trị thứ i trong
    bảng T.
    - +: phép toán cộng modulo 2^32
    

![image.png](attachment:9f9e4ce1-5a91-4c4f-942a-6016dfbd02dd:image.png)

```python
import struct
import math

A = 0x67452301
B = 0xEFCDAB89
C = 0x98BADCFE
D = 0x10325476

S = [
    [7, 12, 17, 22], 
    [5, 9, 14, 20], 
    [4, 11, 16, 23], 
    [6, 10, 15, 21]
]

def binary_to_bytes(binary_string):
    if len(binary_string) % 8 != 0:
        raise ValueError("Chuỗi nhị phân phải có độ dài là bội số của 8.")
    byte_array = bytearray()
    for i in range(0, len(binary_string), 8):
        byte_chunk = binary_string[i:i + 8]
        byte_array.append(int(byte_chunk, 2))
    return bytes(byte_array)

T = [int(2**32 * abs(math.sin(i + 1))) & 0xFFFFFFFF for i in range(64)]

def F(x, y, z): return (x & y) | (~x & z)
def G(x, y, z): return (x & z) | (y & ~z)
def H(x, y, z): return x ^ y ^ z
def I(x, y, z): return y ^ (x | ~z)

# Hàm dịch trái
def left_rotate(x, n):
    return ((x << n) | (x >> (32 - n))) & 0xFFFFFFFF

def ascii_to_binary(message):
    binary_string = ''
    for char in message:
        binary_char = format(ord(char), '08b')
        binary_string += binary_char
    return binary_string

def md5_padding(message):
    binary_char = ascii_to_binary(message.decode())
    original_byte_len = len(binary_char)
    binary_char += '1'
    while len(binary_char) % 512 != 448:
        binary_char += '0'
    binary_char += (format(original_byte_len, '064b'))
    return binary_to_bytes(binary_char)

def md5(message):
    a, b, c, d = A, B, C, D  

    message = md5_padding(message)  

    # Xử lý từng khối 512 bit
    for i in range(0, len(message), 64):
        chunk = message[i:i + 64]
        X = struct.unpack('<16I', chunk)
        aa, bb, cc, dd = a, b, c, d
        for i in range(64):
            if i < 16:
                f = F(b, c, d)
                g = i
            elif i < 32:
                f = G(b, c, d)
                g = (5 * i + 1) % 16
            elif i < 48:
                f = H(b, c, d)
                g = (3 * i + 5) % 16
            else:
                f = I(b, c, d)
                g = (7 * i) % 16
            f = (f + a + T[i] + X[g]) & 0xFFFFFFFF
            a = d
            d = c
            c = b
            b = (b + left_rotate(f, S[i // 16][i % 4])) & 0xFFFFFFFF
        a = (a + aa) & 0xFFFFFFFF
        b = (b + bb) & 0xFFFFFFFF
        c = (c + cc) & 0xFFFFFFFF
        d = (d + dd) & 0xFFFFFFFF
    return struct.pack('<4I', a, b, c, d).hex()

# Nhập chuỗi để băm
input_string = input("Nhập chuỗi cần băm: ")
hashed_value = md5(input_string.encode())
print("MD5 hash value:", hashed_value)
```

</aside>

### 5. Nguyên Tắt Cơ Bản Cracking Hashing Để Bẻ Khóa Mật Khẩu.

 Như đã trình bài ở trên, ta thấy đặc tính cơ bản của hàm băm là tính không thể đảo ngược. nên cách duy nhất tính đến thời điểm hiện tại để bẻ khóa hàm băm là [Thử và Sai] + [Băm + So Sánh Giá Trị Băm]

1. Chọn giải thuật băm dựa trên hàm băm đã có(MD4, MD5, SHA1,SHA512,**PBKDF2, BCrypt, and SCrypt,NTLM**)
    - Việc lựa chọn dãi thuật băm dựa trên hàm băm này dựa trên kinh nghiệm của mọi người thôi.
    - Ví Dụ:
        - Nếu bạn thấy hash value có giá trị 512 bit bạn có thể nghi ngờ là dùng hàm SHA-512.
        - Hoặc dựa vào hệ điều hành, nếu bạn đang tấn công hàm băm trên Windows thì thường là hệ điều hành này dùng NTML để băm mật khẩu người dùng.
        - Nếu bạn tấn công các thiết bị như Iphone thì Iphone sử dụng giải thuật mã hóa đối xứng là AES 256(Nghĩa là cần giải thuật băm để tạo khóa có độ dài 256 bit để mã hóa dữ liệu), bạn có thể nghi ngờ giải thuật băm đó là SHA-256.
    - Lưu ý: nếu chọn sai giải thuật mã hóa thì có Cracking cả đời cũng không ra mật khẩu.
2. Bạn chọn một [ dãi ký tự có độ dài bất kỳ ] mà bạn nghi ngờ là [Password] trong bản mã ASSCII.
3. Bằng giải thuật  băm đã chọn băm dãy ký tự đó.
4. So sánh [ kết vừa quả băm ] với [ giá trị băm ban đầu ].
    - Nếu giống ⇒ thì đó là mật khẩu.
    - Nếu khác ⇒ đó không phải là mật khẩu → bỏ và thử lại với [dãy ký tự] khác.

<aside>
🪶

CODE MINH HỌA:

```python

```

</aside>

### **6. Một Số Kỹ Thuật Tấn Công Hàm Băm Phổ Biến.**

Như vậy, password vẫn được sử dụng rất nhiều. Song song đó, khao khát để phá vỡ tính Bí mật và Bảo mật của password từ các hacker ngày một tăng, bởi khi có được password đúng, hacker có toàn quyền với các tài nguyên/dịch vụ của người dùng được xác thực bởi password đó. Và người dùng hiện nay **thường dùng chung một password cho nhiều dịch vụ khác nhau**.

Các kỹ thuật tấn công password được gọi với nhiều cái tên khác nhau tùy vào các kỹ thuật và cách thức tiếp cận khác nhau, các bạn có thể tham khảo tại [đây](https://www.onelogin.com/learn/6-types-password-attacks). Sau đây là những cái tên phổ biến và đáng chú ý:

1. **Brute Force:** Đây là kiểu tấn công mà chúng ta sẽ “mò” tất cả các tổ hợp ký tự cho đến khi có một tổ hợp ký tự trùng khớp với thông tin đăng nhập để truy cập trái phép vào hệ thống, hacker sẽ sử dụng phương pháp thử và sai để cố gắng đoán thông tin đăng nhập hợp lệ. Thường Brute Force chỉ dùng để "mò" những password yếu, phổ biến, nhắm vào những người dùng thông thường.
    - ***Nguyên Nhân:*** Hình thức tấn công brute-force dễ phòng chống nhưng lại rất dễ gặp phải. Nguyên nhân của kiểu tấn công này là do:
        - Đặt mật khẩu không an toàn, dễ đoán ra, sử dụng phổ biến.
        - Sử dụng mật khẩu liên quan đến bản thân có thể dễ lấy được trên các mạng xã hội như: tên, ngày sinh,bạn bè, người thân, đồng nghiệp, thú cưng, con cái, nhân vật yêu thích.
        - Từ phía sever, việc không giới hạn số lần nhập sai có thể tạo cơ hội cho hacker có thể tấn công brute-force.
    - ***Hậu Quả:***
        - Việc đánh cắp được mật khẩu người dùng luôn đi kèm với những hậu quả vô cùng nghiêm trọng. Có thể nhìn thấy ngay, nạn nhân của Brute Force Attack sẽ bị lộ thông tin đăng nhập và toàn bộ thông tin của tài khoản đó. Kẻ tấn công thực hiện được quyền của người dùng đó, dùng mật khẩu và tên tài khoản đó thử ở tất cả hệ thống khác.
        - Mức độ nghiêm trọng sẽ tùy thuộc vào loại thông tin bị rò rỉ. Nếu tài khoản bị đánh cắp là tài khoản quan trọng của 1 tổ chức nào đó thì cơ sở dữ liệu nhạy cảm từ toàn bộ tổ chức có thể bị lộ trong các vụ vi phạm dữ liệu cấp công ty .
        - Ngoài ra, việc Brute-Force với tần suất cao có thể coi như 1 kiểu tấn công DOS vào hệ thống web đó dẫn tới có thể treo cả server nếu server đó yếu.
    - ***Cách Khắc Phục:***
        
        *Việc khắc phục brute-force có thể đến từ 2 phía: người dùng và quản trị trang web.*
        
        - **Đối với người dùng, để tránh bị brute-force thì có thể làm theo cách sau:**
            - Không sử dụng thông tin liên quan đến bản thân mà có thể lấy được trên mạng như tên, ngày sinh, vv...
            - Có càng nhiều ký tự càng tốt: việc sử dụng từ 10 ký tự trở lên có thể khiến cho việc brute-force tốn rất nhiều thời gian, thời gian có thể lên cả năm trời.
            - Kết hợp các chữ cái, số và các ký hiệu đặc biệt.
            - Tránh sử dụng những mật khẩu đơn giản như: 123456, password,...
            - Bên cạnh đó việc không sử dụng cùng 1 mật khẩu trên nhiều tài khoản khác nhau có thể tránh tối đa hậu quả khi bị mất mật khẩu.
        - **Với quản trị viên, bạn có thể thực hiện các phương pháp để bảo vệ người dùng khỏi việc bẻ khóa mật khẩu bằng brute-force:**
            - Yêu cầu mật khẩu mạnh: bạn có thể buộc người dùng xác định mật khẩu dài và phức tạp. Bạn cũng nên thực thi các thay đổi mật khẩu định kỳ.
            - Hạn chế số lần đăng nhập sai: Giới hạn số lần thử cũng làm giảm khả năng bị tấn công brute-force. Đi kèm với đó là việc làm tăng thời gian cho phép nhập khi nhập quá nhiều lần sai.
            - Xác thực hai yếu tố: Quản trị viên có thể yêu cầu xác thực hai bước và cài đặt hệ thống phát hiện xâm nhập phát hiện các cuộc tấn công. Điều này yêu cầu người dùng theo dõi nỗ lực đăng nhập bằng yếu tố thứ hai, chẳng hạn như khóa USB vật lý hoặc quét sinh trắc học dấu vân tay.
            - Captcha: các công cụ như reCAPTCHA yêu cầu người dùng hoàn thành các tác vụ đơn giản để đăng nhập vào hệ thống. Việc này có thể ngăn chặn các công cụ brute-force tự động.
2. **Dictionary attack:** 
    
    Một loại tấn công bằng vũ lực, tấn công từ điển dựa vào thói quen chọn những từ "cơ bản" làm mật khẩu của chúng ta, trong đó những từ phổ biến nhất được tin tặc tập hợp thành "cracking dictionaries". Các cuộc tấn công từ điển tinh vi hơn sẽ kết hợp những từ có ý nghĩa quan trọng đối với bạn, như nơi sinh, tên con hoặc tên thú cưng.
    
    ***Để giúp ngăn chặn một cuộc tấn công từ điển:***
    
    - Không bao giờ sử dụng từ trong từ điển làm mật khẩu. Nếu bạn đã đọc nó trong sách, nó không bao giờ nên là một phần của mật khẩu của bạn. Nếu bạn phải sử dụng mật khẩu thay vì công cụ quản lý quyền truy cập, hãy cân nhắc sử dụng hệ thống quản lý mật khẩu.
    - Khóa tài khoản sau quá nhiều lần nhập sai mật khẩu. Có thể rất bực bội khi bị khóa khỏi tài khoản khi bạn quên mật khẩu trong chốc lát, nhưng giải pháp thay thế thường là tài khoản mất an toàn. Hãy thử năm lần hoặc ít hơn trước khi ứng dụng yêu cầu bạn bình tĩnh lại.
    - Hãy cân nhắc đầu tư vào trình quản lý mật khẩu. Trình quản lý mật khẩu tự động tạo mật khẩu phức tạp giúp ngăn chặn các cuộc tấn công từ điển.
3.  **Key logger attack:** 
    
    Trước khi bị 'dính' vào kiểu tấn công này, người dùng thường đã bị 'dính' một tấn công nào đó khác, như bị lây nhiễm trojan hay bị mở backdoor, dính Keylog... Qua đó hacker có được thông tin về tổ hợp phím mà người dùng đã sử dụng.
    
4.  **Social engineering attacks:**
    
    Tấn công kỹ nghệ xã hội sử dụng kiến thức và cách thức tiếp cận liên quan tới tâm lý học hành vi, như giả mạo (Phishing / Spear phishing), khơi gợi tính tò mò hoặc tham lam ( Baiting )...
    
5. **Man In the Middle:** 
    
    Trong kiểu tấn công này, hacker không chỉ 'đứng giữa' và nghe ngóng những thông tin được truyền trong mạng, chúng còn có thể gửi xen vào cũng như thay đổi luồng dữ liệu để kiểm soát sâu hơn những thông tin được gửi nhận.
    
6. Rainbow Table: Hầu hết các hệ thống hiện đại lưu trữ mật khẩu trong một hash. Hash sử dụng công thức toán học để tạo ra một chuỗi ngẫu nhiên, khác hoàn toàn với chuỗi đầu vào. Nếu một hacker nào đó truy cập vào database lưu trữ mật khẩu, thì họ sẽ có thể lấy được mật khẩu được mã hóa dưới dạng hash, hacker không thể đọc được mật khẩu, họ cũng sẽ không thể lạm dụng chúng.
7. Credential Stuffing: Các password attack khác đều đề cập đến việc hacker chưa sở hữu mật khẩu của người dùng. Tuy nhiên, với credential stuffing thì khác. Trong một credential stuffing attack, hacker sử dụng tên và mật khẩu bị đánh cắp của một tài khoản trước đó rồi thử trên các tài khoản khác của người dùng. Credential stuffing nhằm vào xu hướng sử dụng chung mật khẩu cho nhiều tài khoản của người dùng, nếu thành công thì thường đem lại hiệu quả rất lớn. Đây là lý do tại sao việc sử dụng các mật khẩu khác nhau cho mỗi tài khoản và dịch vụ là rất quan trọng. Trong trường hợp một trong số chúng bị xâm phạm và bị rò rỉ, rủi ro đối với bất kỳ tài khoản nào khác sẽ được giảm thiểu. Credential stuffing attack có cách gọi khác là credential reuse attack.
    
    ***Nhồi thông tin xác thực(Credential Stuffing)***
    
     ****là phương pháp tấn công mạng trong đó thông tin xác thực thu được từ vi phạm dữ liệu thông qua một ứng dụng được sử dụng để cố gắng xâm nhập vào ứng dụng, trang web hoặc hệ thống khác.
    
    Nhồi thông tin xác thực là một dạng [tấn công brute force](https://www.beyondidentity.com/glossary/brute-force-attack) và có nhiều điểm chung, nhưng có phương pháp luận phức tạp hơn một chút. Tấn công brute force chỉ là cố gắng kết hợp ngẫu nhiên các thông tin xác thực, trong khi tấn công credential stuffing sử dụng các thông tin xác thực đã có trên nhiều trang web khác nhau.
    
    Nếu bạn có xu hướng sử dụng lại mật khẩu của mình, thì có khả năng mật khẩu đó đã bị rò rỉ trên internet trong nhiều vòng tròn không gian mạng khác nhau, khiến bạn trở thành mục tiêu chính cho một cuộc tấn công nhồi thông tin xác thực. Nhồi thông tin xác thực dựa trên bản chất lỏng lẻo của đăng nhập dựa trên thông tin xác thực và tin tặc biết rằng bạn có thể đã sử dụng cùng một tổ hợp đó ở nơi khác. Vì thông tin xác thực thường được mua bán trong các vòng tròn trực tuyến bất chính, nên không thể biết liệu bạn có dễ bị tấn công nhồi thông tin xác thực hay không.
    
    Mặc dù tỷ lệ thành công của cuộc tấn công nhồi thông tin đăng nhập thấp hơn các hình thức tấn công mạng khác ( [thường chỉ 1-3%](https://www.recordedfuture.com/credential-stuffing-attacks/) ), nhưng các cuộc tấn công này được thực hiện hàng loạt, khiến chúng trở thành một trong những phương thức tấn công phổ biến nhất.
    
    ***Cách thức hoạt động của Credential Stuffing:***
    
    Để thực hiện một cuộc tấn công nhồi thông tin xác thực, trước tiên, kẻ tấn công phải có được danh sách các mật khẩu và tên người dùng bị đánh cắp hoặc bị rò rỉ. Thông qua việc sử dụng các công cụ tự động hóa tiên tiến, kẻ tấn công có thể thực hiện cuộc tấn công trên nhiều hệ thống và trang web. Kiểu nhồi thông tin xác thực tự động này có thể dễ dàng đóng cửa cơ sở hạ tầng CNTT của một tổ chức, dẫn đến tình trạng mất điện, gây khó khăn cho tổ chức và tổn thất tài chính. Chỉ riêng điều này cũng có thể gây ra thảm họa, nhưng nếu kẻ tấn công thành công trong việc truy cập vào hệ thống của bạn, thì rắc rối chỉ mới bắt đầu.
    
    Gần đây có báo cáo rằng [việc nhồi thông tin xác thực khiến các doanh nghiệp thiệt hại trung bình 4 triệu đô la mỗi năm](https://www.information-age.com/credential-stuffing-123482099/#:~:text=30%20April%202019-,Credential%20stuffing%20attacks%20are%20costing%20businesses%20an%20average%20of%20%244,conducted%20with%20the%20Ponemon%20Institute.) do thời gian ngừng hoạt động, mất khách hàng, chi phí CNTT và mất lòng tin vào tương lai của công ty hoặc sản phẩm. Ngoài những tổn thất tiềm ẩn đó, các cơ quan quản lý gần đây đã đàn áp các tổ chức bị tấn công nhồi thông tin xác thực và doanh nghiệp của bạn có thể phải chịu hình phạt hoặc hành động pháp lý nếu hệ thống của bạn chứng minh được lỗ hổng bảo mật theo GDPR mới và các quy định về quyền riêng tư của Hoa Kỳ.
    
    ***Làm thế nào để ngăn chặn việc nhồi thông tin xác thực***
    
    Nếu những số liệu thống kê này khiến bạn lo lắng, thì bạn có quyền lo lắng. Việc nhồi nhét thông tin xác thực có thể gây hại và khó ngăn ngừa, nhưng may mắn thay, chúng tôi đã đưa ra một số điểm về cách ngăn ngừa nó...
    
    - **Loại bỏ mật khẩu:**[Tìm hiểu thêm về xác thực không cần mật khẩu ngay hôm nay và giữ an toàn cho các ứng dụng quan trọng nhất của bạn](https://www.beyondidentity.com/get-demo)
        
        CÁCH DUY NHẤT để đảm bảo ngăn chặn các cuộc tấn công dựa trên mật khẩu là loại bỏ mật khẩu.
        
    - **Captcha**: Vì reCAPTCHA yêu cầu con người phải hoàn tất quá trình đăng nhập thông qua một câu đố hoặc câu hỏi, nên nó không thể được thực hiện tự động. Yêu cầu duy nhất là nhập một từ, ký hiệu hoặc hình ảnh rất thành công trong việc ngăn chặn những kẻ tấn công nhồi thông tin xác thực.
    - **Tường lửa ứng dụng web**: Tường lửa ứng dụng web cực kỳ có giá trị đối với bất kỳ tổ chức nào. Một WAF đáng tin cậy có thể phát hiện lưu lượng truy cập bất thường, bot, nỗ lực đăng nhập quá mức, v.v. Một WAF có nhiều mục đích và được sử dụng cho nhiều mục đích bảo mật khác nhau, vì vậy không có nhược điểm nào đối với một WAF.
    - **Thường xuyên kiểm tra thông tin đăng nhập bị rò rỉ**[HaveIBeenPwned.com](https://haveibeenpwned.com/): Có nhiều nhà cung cấp dịch vụ có thể tự động quét web để tìm thông tin đăng nhập bị rò rỉ và cảnh báo người dùng về tên người dùng và/hoặc mật khẩu bị xâm phạm.
    
    cũng là một trang web miễn phí dành cho tất cả mọi người vì mục đích này. Tuy nhiên, điều này chỉ có giá trị nếu thông tin bị rò rỉ đã được công khai—bất kỳ vi phạm dữ liệu nào vẫn chưa được công bố hoặc đã bị phát hiện sẽ không xuất hiện.
    
    Nhồi thông tin xác thực là mối lo ngại thực sự đối với hầu hết các tổ chức, do những rủi ro lớn mà nó gây ra. Ngay cả với những mẹo này, trước đây vẫn không có gì đảm bảo rằng thông tin xác thực của bạn sẽ không bị một số nguồn bất chính phát hiện—cho đến bây giờ.
    
    Nhồi thông tin xác thực không hoạt động nếu không có thông tin xác thực. [Xóa mật khẩu](https://www.beyondidentity.com/get-demo) là điều hiệu quả nhất bạn có thể làm để ngăn chặn nhồi thông tin xác thực và nên là cách số một để ngăn chặn nó.
    
8. Password Spraying: Khá giống với hình thức brute force nhưng không được xem là brute force, password spraying thử hàng ngàn có thể là hàng triệu tài khoản cùng một lúc với một vài mật khẩu thường được sử dụng. Trong số đó nếu có một người dùng có mật khẩu yếu, toàn bộ hệ thống có thể gặp rủi ro. Brute force tập trung vào một vài tài khoản. Ngược lại, password spraying sẽ mở rộng các mục tiêu theo cấp số nhân. Do đó, nó giúp hacker tránh phương thức bảo mật khóa tài khoản khi đăng nhập sai nhiều lần. Password spraying đặc biệt nguy hiểm đối với các cổng xác thực đăng nhập một lần.
9. Offline Detection: Việc thu thập thông tin người dùng từ máy tính bị vứt bỏ, thùng rác...; nghe lén khi người dùng chia sẻ mật khẩu của họ với người khác bằng lời nói; đọc ghi chú kẹp trên màn hình máy tính; lướt qua khi người dùng nhập mật khẩu... có thể giúp hacker có được mật khẩu và thông tin đăng nhập người dùng.
10. **Hash Cracking: Không giống như mã hóa, băm không thể đảo ngược. Cách duy nhất để "khôi phục" mật khẩu từ băm là đoán xem mật khẩu là gì, chạy nó qua thuật toán băm và xem kết quả có khớp với băm bạn có không. Như bạn mong đợi với một thách thức tốn thời gian và nhiều như vậy, công cụ mà kẻ tấn công có thể sử dụng rất hoàn thiện; John the Ripper và Hashcat cùng nhau hỗ trợ một số lượng lớn các loại băm với đủ loại tính năng lạ mắt và tối ưu hóa hiệu suất đặc biệt. Tuy nhiên, vào cuối ngày, thách thức lớn nhất không phải là phần mềm - mà là phần cứng.**

## II. Ví Dụ Tấn Công Minh Họa.

<aside>
🪶

### **Dictionary attack + Social engineering attacks.** (HASH CRACKING)

**I. Coppy file hash mật khẩu trên Windowns 7**

- Coppy sam + system (open terminal by administrator)
1. reg save HKLM\sam ./sam.save
2. reg save HKLM\system ./system.save

![image.png](attachment:bb173893-adaf-4e48-a706-f0846eabe2bc:image.png)

1. Coppy file [same.save](http://same.save) && [system.save](http://system.save) qua kali linux(C:\Windows\system32> explorer .)

**II. Dùng công cụ để trích hash mật khẩu và thực hiện tấn công trên kali**

1. Sử dụng công cụ **impacket-secretsdump để trích hash mật khẩu.**

impacket-secretsdump -sam sam.save -system system.save LOCAL

- **`impacket-secretsdump`**: Công cụ dùng để trích xuất hash mật khẩu, NTLM hash, và các thông tin đăng nhập khác từ Windows.
- **`sam sam.save`**: Chỉ định file **SAM** đã lưu. File này chứa thông tin tài khoản người dùng và hash mật khẩu.
- **`system system.save`**: Chỉ định file **SYSTEM** đã lưu. File này chứa khóa mã hóa cần thiết để giải mã hash trong file SAM.
- **`LOCAL`**: Chạy trích xuất trên hệ thống cục bộ.

![image.png](attachment:9f9f62d1-0e03-4f45-9250-c6d783069397:image.png)

1. Coppy hash vào file hashes.txt.

![image.png](attachment:cdecd8d3-cd55-4401-bef7-3e7c7e56e16d:image.png)

1. Sử dụng công cụ **cupp -i** để tạo bản từ điển liên quan đến nạn nhân.

![image.png](attachment:5237fa62-0b11-4eb4-84e0-9cf9ec8c2a44:image.png)

![image.png](attachment:dcb620f6-a02a-4479-b4b5-7ffcb2f1f83e:image.png)

Sau khi thành công tạo cupp hacker đã tạo được một danh sách từ điển được hoán vị từ những từ ngữ thân thuộc với nạn nhân. Trong ví dụ trên ta được danh sách từ điển có 54159 từ liên quan đến nạn nhân.

![Screenshot 2025-02-19 150238.png](attachment:46d1b999-0d8c-498d-a48e-d3914c30f682:Screenshot_2025-02-19_150238.png)

![image.png](attachment:831c6ae1-fb23-4235-9be3-8606c09dbb51:image.png)

![Screenshot 2025-02-19 150413.png](attachment:a11ed43a-2405-4d4d-8afb-dda8c3790e37:Screenshot_2025-02-19_150413.png)

1. Sử dụng công cụ hashcat hoặc john để tấn công hàm băm.

hashcat -m 1000 -a 0 hashes.txt dang.txt

![image.png](attachment:908c70ca-4d21-4bbe-9501-422f11311f74:image.png)

![image.png](attachment:bc2f1fde-3be9-49db-8765-fa7701151ea5:image.png)

Hiển thị mk:

![image.png](attachment:1cae791e-9ee7-462f-b503-94d91c93e7b9:image.png)

- **Kiến thức cơ bản về hashcat**
    
    Hashcat hoạt động dựa trên các giá trị băm. Bạn cần cung cấp:
    
    - **Danh sách băm**: Tệp chứa các giá trị băm (hashes).
    - **Tệp từ điển (wordlist)**: Danh sách các mật khẩu tiềm năng.
    - **Chế độ tấn công**: Cách Hashcat sẽ thử các mật khẩu (brute-force, từ điển, kết hợp, v.v.).
    
    # **Các chế độ tấn công trong Hashcat**
    
    Hashcat hỗ trợ nhiều chế độ tấn công, bao gồm:
    
    ### **1. Từ điển (Dictionary Attack) - “-a 0”**
    
    - Sử dụng một danh sách từ điển để thử mật khẩu.
    - Cú pháp:
        
        ```bash
        hashcat -m <hash_type> -a 0 <hash_file> <wordlist>
        
        ```
        
        - **<hash_type>**: Loại giá trị băm (xem bảng hash type bên dưới).
        - **<hash_file>**: Tệp chứa giá trị băm.
        - **<wordlist>**: Tệp từ điển mật khẩu.
    
    ### **2. Brute-force “-a 3”**
    
    - Thử mọi kết hợp có thể của các ký tự.
    - Cú pháp:
        
        ```bash
        bash
        Sao chép mã
        hashcat -m <hash_type> -a 3 <hash_file> <mask>
        
        ```
        
        - **<mask>**: Mẫu kết hợp ký tự, ví dụ:
            - `?l`: Chữ thường (a-z).
            - `?u`: Chữ hoa (A-Z).
            - `?d`: Số (0-9).
            - `?s`: Ký tự đặc biệt.
    
    ### **3. Hybrid “-a 6”**
    
    - Kết hợp giữa từ điển và brute-force.
    - Cú pháp:
        
        ```bash
        
        hashcat -m <hash_type> -a 6 <hash_file> <wordlist> <mask>
        
        ```
        
    
    ### **4. Combinator**
    
    - Kết hợp hai danh sách từ điển.
    - Cú pháp:
        
        ```bash
        bash
        Sao chép mã
        hashcat -m <hash_type> -a 1 <hash_file> <wordlist1> <wordlist2>
        
        ```
        
    
    ---
    
    ## **4. Các loại giá trị băm (Hash Type)**
    
    Dưới đây là một số mã hash type phổ biến trong Hashcat:
    
    - **0**: MD5
    - **100**: SHA1
    - **1400**: SHA256
    - **500**: md5crypt, MD5(Unix)
    - **1800**: sha512crypt, SHA512(Unix)
    - **3200**: bcrypt
    - **1000**: NTLM (Windows)
    - **2500**: WPA/WPA2 (Wi-Fi)
    - `-m 13600` là mã của loại hash `$zip2$`.
    
    Để xem danh sách đầy đủ, chạy lệnh:
    
    ```bash
    hashcat --help
    ```
    
- Kiến thức cơ bản về john-ripper:
    
    ### **Trên Linux**
    
    1. **Cài đặt john qua package manager**:
        
        ```bash
        sudo apt install john
        ```
        
        ## **2. Cách sử dụng cơ bản**
        
        ### **Cú pháp lệnh**
        
        ```bash
        john [tùy chọn] [tệp hash]
        ```
        
        ## **3. Các bước sử dụng John the Ripper**
        
        ### **Bước 1: Chuẩn bị giá trị băm**
        
        - Tệp băm thường chứa các giá trị băm mật khẩu cần bẻ khóa.
        - Định dạng băm được hỗ trợ bao gồm: MD5, SHA-1, bcrypt, NTLM, v.v.
        
        Nếu bạn không chắc loại băm, dùng lệnh:
        
        ```bash
        john --list=formats
        ```
        
        ---
        
        ### **Bước 2: Tạo tệp hash**
        
        Ví dụ, tạo tệp `hashes.txt` chứa các giá trị băm:
        
        ```swift
        $6$rounds=5000$TgawQs...v0m9Mba1k
        $1$abcdefgh$0qF4tIRpvv1jFV8
        ```
        
        ---
        
        ### **Bước 3: Chạy John**
        
        ### **a. Tấn công mặc định**
        
        - Chạy John với tệp `hashes.txt`:
            
            ```bash
            john hashes.txt
            ```
            
        - John sẽ tự động sử dụng từ điển mặc định để kiểm tra mật khẩu.
        
        ### **b. Sử dụng từ điển tùy chỉnh**
        
        - Cung cấp tệp từ điển (wordlist) của riêng bạn:
            
            ```bash
            john --wordlist=/path/to/wordlist.txt hashes.txt
            ```
            
        
        ### **c. Tấn công brute-force**
        
        - Chạy brute-force (incremental mode):
            
            ```bash
            john --incremental hashes.txt
            ```
            
            - **Incremental mode** sẽ thử tất cả các mật khẩu có thể từ ngắn đến dài.
        
        ### **d. Chế độ "Single Crack"**
        
        - Tận dụng thông tin từ username hoặc mật khẩu cũ trong tệp:
            
            ```bash
            john --single hashes.txt
            ```
            
        
        ### **e. Chế độ xác định kiểu băm**
        
        - Nếu bạn biết loại băm, chỉ định nó:
            
            ```bash
            john --format=<format> hashes.txt
            ```
            
            - **<format>**: Loại băm, ví dụ:
                - `md5`, `sha1`, `bcrypt`, `ntlm`, v.v.
        
        ---
        
        ## **4. Các lệnh hữu ích**
        
        ### **Hiển thị kết quả bẻ khóa**
        
        - Sau khi chạy xong, hiển thị mật khẩu đã bẻ khóa:
            
            ```bash
            john --show hashes.txt
            ```
            
        
        ### **Tiếp tục từ lần chạy trước**
        
        - Nếu quá trình bị gián đoạn, bạn có thể tiếp tục:
            
            ```bash
            john --restore
            ```
            
        
        ### **Xóa kết quả cũ**
        
        - Xóa thông tin bẻ khóa trước đó để chạy lại từ đầu:
            
            ```bash
            john --session=new_session --wordlist=/path/to/wordlist.txt hashes.txt
            ```
            
        
        ### **Kiểm tra tốc độ bẻ khóa**
        
        - Đo tốc độ thử mật khẩu:
            
            ```bash
            john --test
            ```
            
        
        ---
        
        ## **5. Ví dụ cụ thể**
        
        ### **Ví dụ 1: Bẻ khóa mật khẩu MD5**
        
        1. Tạo tệp `hashes.txt` với nội dung:
            
            ```
            5d41402abc4b2a76b9719d911017c592
            ```
            
        2. Chạy lệnh:
            
            ```bash
            john --format=raw-md5 hashes.txt
            
            ```
            
        
        ### **Ví dụ 2: Tấn công từ điển với NTLM**
        
        1. Tệp băm `hashes.txt`:
            
            ```
            8846f7eaee8fb117ad06bdd830b7586c
            
            ```
            
        2. Tệp từ điển `rockyou.txt`.
        3. Lệnh:
            
            ```bash
            john --wordlist=rockyou.txt --format=nt hashes.txt
            ```
            
        
        ---
        
        ## **6. Tối ưu hóa hiệu suất**
        
        - **Tăng tốc với GPU**:
        Nếu cài đặt bản Jumbo, bạn có thể dùng GPU để tăng tốc bẻ khóa:
            
            ```bash
            john --device=gpu hashes.txt
            ```
            
        - **Điều chỉnh bộ nhớ**:
        Với thuật toán như bcrypt, có thể điều chỉnh hiệu suất:
            
            ```bash
            john --format=bcrypt --fork=4 hashes.txt
            ```
            
        
</aside>

<aside>
🪶

1. **Brute Force**
- Giả sử ta có file pwd.txt đã được đặt mật khẩu 6 số

![image.png](attachment:ffec0b2a-2e2f-45c1-a61e-f1c564ba34b1:image.png)

- Trích xuất hàm băm của mật khẩu bằng công cụ zip2john:

```html
zip2john pwd.txt.zip > hash
```

![image.png](attachment:2a32d3fa-91c8-4155-8421-87eca3ca96f4:image.png)

- xóa ký tự thừa

![image.png](attachment:f8ec0618-064e-4689-8e9b-a7f428cf5339:image.png)

- Sử dụng công cụ hashcat để dò bute focre

```html
hashcat -m 13600 -a 3 hash ?d?d?d?d?d?d
```

![Screenshot 2025-02-20 233524.png](attachment:6c13d740-1b52-40d2-945e-91892925fdab:Screenshot_2025-02-20_233524.png)

![Screenshot 2025-02-20 233630.png](attachment:0be0e3c2-fb51-4ba8-af46-fdd08a005b9b:Screenshot_2025-02-20_233630.png)

![Screenshot 2025-02-20 233710.png](attachment:48efd389-7dbe-418a-adba-fc546e078c55:Screenshot_2025-02-20_233710.png)

</aside>

<aside>
🪶

1. Rainbow Table
</aside>

<aside>
🪶

1. Credential Stuffing
</aside>

# B - ARP SPOOFING - ARP

## **I. ARP Spoofing.**

### 1. ARP là gì?

- ARP là phương thức phân giải địa chỉ động giữa địa chỉ lớp network và địa chỉ lớp datalink. Quá trình thực hiện bằng cách: một thiết bị IP trong mạng gửi một gói tin local broadcast đến toàn mạng yêu cầu thiết bị khác gửi trả lại địa chỉ phần cứng ( địa chỉ lớp datalink ) hay còn gọi là Mac Address của mình.
- ARP là giao thức lớp 2 - Data link layer trong mô hình OSI và là giao thức lớp Link layer trong mô hình TCP/IP.
- Ban đầu ARP chỉ được sử dụng trong mạng Ethernet để phân giải địa chỉ IP và địa chỉ MAC. Nhưng ngày nay ARP đã được ứng dụng rộng rãi và dùng trong các công nghệ khác dựa trên lớp hai.

![image.png](attachment:b35286b0-f68b-4b9a-b67f-5ce93f3cf53f:image.png)

### 2. ARP Spoofing là gì?

- Trong mạng máy tính, **ARP spoofing**, **ARP cache poisoning**, hay **ARP poison routing**, là một kỹ thuật qua đó kẻ tấn công giả thông điệp ARP trong [mạng cục bộ](https://vi.wikipedia.org/wiki/M%E1%BA%A1ng_c%E1%BB%A5c_b%E1%BB%99). Nói chung, mục tiêu là kết hợp địa chỉ MAC của kẻ tấn công với địa chỉ IP của máy chủ khác, chẳng hạn như cổng mặc định (default gateway), làm cho bất kỳ lưu lượng truy cập nào dành cho địa chỉ IP đó được gửi đến kẻ tấn công.
- ARP spoofing có thể cho phép kẻ tấn công chặn các khung dữ liệu trên mạng, sửa đổi lưu lượng, hoặc dừng tất cả lưu lượng. Thông thường cuộc tấn công này được sử dụng như là một sự mở đầu cho các cuộc tấn công khác, chẳng hạn như [tấn công từ chối dịch vụ](https://vi.wikipedia.org/wiki/T%E1%BA%A5n_c%C3%B4ng_t%E1%BB%AB_ch%E1%BB%91i_d%E1%BB%8Bch_v%E1%BB%A5), tấn công [Man-in-the-middle attack](https://vi.wikipedia.org/wiki/Man-in-the-middle_attack), hoặc các cuộc tấn công cướp liên lạc dữ liệu.[[1]](https://vi.wikipedia.org/wiki/ARP_spoofing#cite_note-Ramachandran-2005-p239-1)
- Cuộc tấn công này chỉ có thể dùng trong các mạng mà dùng [Address Resolution Protocol](https://vi.wikipedia.org/wiki/Address_Resolution_Protocol), và giới hạn trong các mạng cục bộ.
- Nguyên tắc cơ bản đằng sau ARP spoofing là khai thác sự thiếu chứng thực trong giao thức ARP bằng cách gửi thông tin ARP giả mạo vào mạng LAN. Các cuộc tấn công giả mạo ARP có thể chạy từ máy chủ bị xâm nhập trên mạng LAN hoặc từ máy của kẻ tấn công được kết nối trực tiếp với mạng LAN bị nhắm tới.
- Nói chung, mục tiêu của cuộc tấn công là kết hợp địa chỉ MAC host của kẻ tấn công với địa chỉ IP của máy đích, do đó bất kỳ lưu lượng truy cập nào dành cho máy đích sẽ được gửi đến máy của kẻ tấn công. Kẻ tấn công có thể chọn để kiểm tra các gói tin (theo dõi), trong khi chuyển tiếp lưu lượng truy cập tới đích thực sự để tránh phát hiện, sửa đổi dữ liệu trước khi chuyển tiếp nó (tấn công xen giữa) hoặc khởi chạy [tấn công từ chối dịch vụ](https://vi.wikipedia.org/wiki/T%E1%BA%A5n_c%C3%B4ng_t%E1%BB%AB_ch%E1%BB%91i_d%E1%BB%8Bch_v%E1%BB%A5) bằng cách gây ra một số hoặc tất cả các gói tin trên mạng sẽ bị bỏ đi.

![image.png](attachment:9c4153e6-2f50-4cc5-b29c-2348cf8fd9f2:image.png)

### **3. Lỗ hổng của ARP**

- [Address Resolution Protocol](https://vi.wikipedia.org/wiki/Address_Resolution_Protocol) là một [giao thức truyền thông](https://vi.wikipedia.org/wiki/Giao_th%E1%BB%A9c_truy%E1%BB%81n_th%C3%B4ng) được sử dụng rộng rãi để tìm ra các địa chỉ [tầng liên kết dữ liệu](https://vi.wikipedia.org/wiki/T%E1%BA%A7ng_li%C3%AAn_k%E1%BA%BFt_d%E1%BB%AF_li%E1%BB%87u) từ các địa chỉ [tầng mạng](https://vi.wikipedia.org/wiki/T%E1%BA%A7ng_m%E1%BA%A1ng).[[note 1]](https://vi.wikipedia.org/wiki/ARP_spoofing#cite_note-3)
- Khi một gói tin (datagram) [Giao thức Internet](https://vi.wikipedia.org/wiki/Giao_th%E1%BB%A9c_Internet) (IP) được gửi từ một máy đến máy khác trong mạng cục bộ, địa chỉ IP đích phải được giải quyết thành địa chỉ [MAC](https://vi.wikipedia.org/wiki/MAC) để truyền qua [tầng liên kết dữ liệu](https://vi.wikipedia.org/wiki/T%E1%BA%A7ng_li%C3%AAn_k%E1%BA%BFt_d%E1%BB%AF_li%E1%BB%87u). Khi biết được địa chỉ IP của máy đích, và địa chỉ MAC của nó cần truy cập, một gói tin broadcast được gửi đi trên mạng nội bộ. Gói này được gọi là *ARP request*. Máy đích với IP trong ARP request sẽ trả lời với *ARP reply*, nó chứa địa chỉ MAC cho IP đó.[[2]](https://vi.wikipedia.org/wiki/ARP_spoofing#cite_note-Lockhart-2007-p184-2)
- ARP là một [giao thức phi trạng thái](https://vi.wikipedia.org/w/index.php?title=Giao_th%E1%BB%A9c_phi_tr%E1%BA%A1ng_th%C3%A1i&action=edit&redlink=1). Máy chủ mạng sẽ tự động lưu trữ bất kỳ ARP reply nào mà chúng nhận được, bất kể máy khác có yêu cầu hay không. Ngay cả các mục ARP chưa hết hạn sẽ bị ghi đè khi nhận được gói tin ARP reply mới. Không có phương pháp nào trong giao thức ARP mà giúp một máy có thể xác nhận máy mà từ đó gói tin bắt nguồn. Hành vi này là lỗ hổng cho phép ARP spoofing xảy ra.[[2]](https://vi.wikipedia.org/wiki/ARP_spoofing#cite_note-Lockhart-2007-p184-2)

### 4. Cách Tấn Công:

1. Kẻ tấn công phải có quyền truy cập vào mạng. Chúng quét mạng để xác định [địa chỉ IP](https://vietnix.vn/dia-chi-ip-la-gi/) của ít nhất hai thiết bị⁠ — giả sử đây là một máy trạm và một bộ định tuyến.

2. Kẻ tấn công sử dụng một công cụ giả mạo, chẳng hạn như Arpspoof hoặc Driftnet, để gửi phản hồi ARP giả mạo.

3. Các phản hồi giả mạo thông báo rằng địa chỉ MAC chính xác cho cả hai địa chỉ IP, thuộc bộ định tuyến và máy trạm (workstation), là địa chỉ MAC của kẻ tấn công. Điều này đánh lừa cả bộ định tuyến và máy trạm kết nối với máy của kẻ tấn công, thay vì kết nối với nhau.

4. Hai thiết bị cập nhật các mục bộ nhớ cache ARP của chúng và từ thời điểm đó trở đi, giao tiếp với kẻ tấn công thay vì trực tiếp với nhau.

5. Kẻ tấn công hiện đang bí mật đứng giữa mọi liên lạc.

![image.png](attachment:edac4e25-4617-4759-b01f-f2dcfd22e1a7:image.png)

### 5. Cách phát hiện cuộc tấn công ARP spoofing

Dưới đây là một cách đơn giản để phát hiện bộ nhớ cache ARP của một thiết bị cụ thể đã bị nhiễm độc, bằng cách sử dụng command line. Khởi động trình hệ điều hành với tư cách quản trị viên. Sử dụng lệnh sau để hiển thị bảng ARP, trên cả Windows và Linux:

```
arp -n
```

- Output:

| **IP Address** | MAC Address |
| --- | --- |
| **192.168.5.1** | 00-14-22-01-23-45 |
| **192.168.5.201** | 40-d4-48-cr-55-b8 |
| **192.168.5.202** | 00-14-22-01-23-45 |

Nếu bảng chứa hai địa chỉ IP khác nhau có cùng địa chỉ MAC, chứng tỏ một cuộc tấn công ARP đang diễn ra. Vì địa chỉ IP 192.168.5.1 có thể được nhận dạng là bộ định tuyến nên IP của kẻ tấn công có thể là 192.168.5.202.

### **6. Cách phòng chống ARP spoofing**

- Sử dụng Mạng riêng ảo (Virtual Private Network – [VPN](https://en.wikipedia.org/wiki/Virtual_private_network)) cho phép các thiết bị kết nối với Internet thông qua một tunnel được mã hóa. Điều này làm cho tất cả thông tin liên lạc được mã hóa và vô giá trị đối với kẻ tấn công ARP spoofing.
- Sử dụng ARP⁠ tĩnh – giao thức ARP cho phép xác định mục nhập ARP tĩnh cho địa chỉ IP và ngăn thiết bị nghe phản hồi ARP cho địa chỉ đó. Ví dụ: nếu một máy tính luôn kết nối với cùng một bộ định tuyến, bạn có thể xác định một mục ARP tĩnh cho bộ định tuyến đó, điều này giúp ngăn chặn một cuộc tấn công.
- Sử dụng packet filtering⁠ – các packet filtering⁠ có thể xác định các gói ARP bị nhiễm độc bằng cách phát hiện chúng chứa thông tin nguồn xung đột và ngăn chúng lại trước khi chúng đến được các thiết bị trên mạng của bạn.
- Thực hiện một cuộc tấn công ARP spoofing⁠ – kiểm tra xem các hệ thống bảo mật hiện tại của bạn có đang hoạt động hay không bằng cách thực hiện một cuộc tấn công ARP spoofing với sự phối hợp của các nhóm Công nghệ thông tin và bảo mật. Nếu cuộc tấn công thành công, hãy xác định điểm yếu trong các biện pháp bảo mật của bạn và khắc phục chúng.

## II. Mô Phỏng Cuộc Tấn Công ARP Spoofing Trong Thực Tế:

# C- DNS **POISONING and** DNS SPOOFING

## I. DNS Spoofing.

### 1. DNS là gì.

DNS (Domain Name System) là hệ thống phân giải tên miền, giúp chuyển đổi tên miền mà con người dễ nhớ (như `google.com`) thành địa chỉ IP (như 8.8.8.8) mà máy tính có thể hiểu và sử dụng để kết nối đến các máy chủ trên Internet.

- Cách hoạt động của DNS:
    1. **Người dùng nhập tên miền** vào trình duyệt (ví dụ: `google.com`).
    2. **Trình duyệt kiểm tra cache** để xem địa chỉ IP có được lưu trữ không.
    3. **Nếu không có**, truy vấn sẽ được gửi đến **DNS Resolver** (do ISP cung cấp hoặc DNS công cộng như Google DNS `8.8.8.8`).
    4. **DNS Resolver truy vấn tiếp** qua nhiều cấp:
        - **Root DNS Server**: Hướng dẫn truy vấn đến máy chủ DNS cấp cao hơn.
        - **TLD DNS Server** (ví dụ `.com`, `.net`...): Cung cấp thông tin về máy chủ quản lý tên miền cụ thể.
        - **Authoritative DNS Server**: Trả về địa chỉ IP thực của tên miền đó.
    5. **Trình duyệt nhận địa chỉ IP** và kết nối đến máy chủ web.

### 2. DNS Spoofing.

DNS Spoofing (hay DNS Cache Poisoning) là một kỹ thuật tấn công trong đó kẻ tấn công **chèn thông tin giả mạo** vào bộ nhớ cache của máy chủ DNS hoặc thiết bị của nạn nhân, khiến người dùng truy cập vào một trang web giả mạo thay vì trang web thật.

## **Cách thức hoạt động của DNS Spoofing**

1. **Kẻ tấn công gửi dữ liệu DNS giả mạo**
    - Khi một máy tính gửi yêu cầu phân giải tên miền, kẻ tấn công sẽ phản hồi với địa chỉ IP giả trước khi máy chủ DNS hợp lệ có thể phản hồi.
    - Máy tính của nạn nhân sẽ lưu lại địa chỉ IP giả vào cache và sử dụng nó trong lần truy cập sau.
2. **Nạn nhân bị chuyển hướng**
    - Khi nạn nhân nhập một trang web hợp lệ (ví dụ: `bank.com`), máy tính sẽ sử dụng địa chỉ IP giả mạo đã bị nhiễm trong cache.
    - Kết quả là nạn nhân bị đưa đến một **trang web lừa đảo** do kẻ tấn công kiểm soát (ví dụ: một trang web giả giống hệt trang ngân hàng để đánh cắp thông tin đăng nhập).

## **Các phương pháp DNS Spoofing phổ biến**

🔹 **1. Poisoning DNS Cache (Đầu độc bộ nhớ DNS)**

- Kẻ tấn công gửi phản hồi DNS giả mạo đến máy chủ DNS để nó lưu trữ dữ liệu sai lệch.
- Khi người dùng khác truy vấn DNS, họ sẽ nhận thông tin sai và bị chuyển hướng đến trang web độc hại.

🔹 **2. Man-in-the-Middle (MitM) Attack trên DNS**

- Kẻ tấn công chặn các yêu cầu DNS từ nạn nhân và trả lời bằng địa chỉ IP giả trước khi máy chủ hợp lệ có thể phản hồi.

🔹 **3. ARP Spoofing kết hợp DNS Spoofing**

- Kẻ tấn công sử dụng ARP Spoofing để giả mạo địa chỉ MAC của máy chủ DNS hợp lệ, sau đó gửi phản hồi DNS giả đến nạn nhân.

## **Cách phòng chống DNS Spoofing**

✅ **Sử dụng DNSSEC** – Cung cấp chữ ký số để xác thực DNS.

✅ **Xóa cache DNS thường xuyên** – Tránh giữ lại thông tin DNS giả mạo.

✅ **Dùng máy chủ DNS tin cậy** – Google DNS (`8.8.8.8`), Cloudflare (`1.1.1.1`).

✅ **Bật HTTPS & kiểm tra chứng chỉ SSL** – Đảm bảo trang web là chính thống.

✅ **Sử dụng VPN** – Mã hóa truy vấn DNS để tránh bị tấn công.

![image.png](attachment:78c78337-43f4-4386-a496-3ecabeeeba38:image.png)

## **Ví dụ về đầu độc bộ nhớ đệm DNS**

Kịch bản sau đây minh họa một cuộc tấn công đầu độc bộ đệm DNS. Trong cuộc tấn công này, kẻ tấn công (IP 192.168.3.300) chặn kênh liên lạc giữa máy khách (IP 192.168.1.100) và máy chủ thuộc trang web www.estores.com (IP 192.168.2.200).

Để thực hiện cuộc tấn công này, kẻ tấn công sử dụng một công cụ như arpspoof để đánh lừa máy khách tin rằng IP của máy chủ là 192.168.3.300. Đồng thời, máy chủ bị lừa nghĩ rằng IP của máy khách cũng là 192.168.3.300.

Dưới đây là kịch bản diễn biến của cuộc tấn công:

1. Kẻ tấn công sử dụng arpspoof để sửa đổi địa chỉ MAC trong bảng ARP của máy chủ, khiến máy chủ tin rằng máy tính của kẻ tấn công thuộc về máy khách.
2. Kẻ tấn công lại sử dụng arpspoof để thông báo cho máy khách rằng máy tính của kẻ tấn công chính là máy chủ.
3. Bằng cách đưa ra lệnh Linux “echo 1 > /proc/sys/net/ipv4/ip_forward”, kẻ tấn công đảm bảo rằng các gói IP được gửi giữa máy khách và máy chủ được chuyển tiếp đến máy tính của kẻ tấn công.
4. Kẻ tấn công tạo một tệp máy chủ, 192.168.3.300 estores.com, trên máy tính cục bộ của họ. Tệp này ánh xạ trang web www.estores.com đến IP cục bộ của kẻ tấn công.
5. Một máy chủ web giả được tạo trên IP cục bộ của kẻ tấn công, trông giống như www.estores.com.
6. Một công cụ như dnsspoof chuyển hướng tất cả các yêu cầu DNS đến tệp máy chủ cục bộ của kẻ tấn công. Kết quả là, người dùng được cung cấp một trang web giả mạo và tương tác với nó dẫn đến việc cài đặt phần mềm độc hại trên máy tính của họ.

## II. Mô Phỏng Cuộc Tấn Công DNS Spoofing Trong Thực Tế.

<aside>
🥋

# TÀI LIỆU THAM KHẢO

### 1. Password Attack

[Tìm hiểu về Password và Password Attacks hiện nay](https://viblo.asia/p/tim-hieu-ve-password-va-password-attacks-hien-nay-aWj53e7GZ6m)

https://www.onelogin.com/learn/6-types-password-attacks

https://www.saigonlab.edu.vn/ki-thuat-password-attack.html

https://www.techtarget.com/searchsecurity/definition/dictionary-attack

https://www.beyondidentity.com/glossary/dictionary-attack

Brute force Atk: https://viettelidc.com.vn/tin-tuc/brute-force-attack-la-gi-va-lam-the-nao-de-chong-cho-wordpress

Hash cracking:https://viblo.asia/p/luan-ve-password-hashing-yMnKMOJzl7P

https://howkteam.vn/course/16-gioi-thieu-ve-ethical-hacking--cac-loai-chinh-sach-bao-mat/82-nghe-trom--arp-poisoning-tan-cong-spoofingthiet-lap-dia-chi-mac-dns-poisoningwireshark-3818

### 2. ARP Spoofing

ARP là gì:https://github.com/hocchudong/thuctap012017/blob/master/TamNT/T%C3%ACm%20hi%E1%BB%83u%20giao%20th%E1%BB%A9c%20ARP.md#1.2

https://vietnix.vn/arp-spoofing-la-gi/?gad_source=1&gclid=CjwKCAiAnpy9BhAkEiwA-P8N4lCu8EpDWv49qILkekvhdOIxgNzT1O325wL2cw-zol1Dl3Q53PnMxhoCQ78QAvD_BwE

### 3. DNS Spoofing

Ảnh minh họa: https://www.cloudflare.com/learning/dns/dns-cache-poisoning/

</aside>

<aside>
🥋

# Note

- Nhồi thông tin xác thực:
</aside>
