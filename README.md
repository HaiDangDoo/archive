## Tất Tần Tật Về An Toàn Thông Tin
Những ghi chú khác: https://www.notion.so/haidanglee/Study-754fd9f03c0f49d89f8b2e4fcc061b6e
---
---

## Phần 1: Sơ cấp

### 📌Kiểm tra cài đặt

```bash
git --version
```

---

### 🔹Cấu hình Git

Thiết lập tên và email (dùng để xác định tác giả commit):

```bash
git config --global user.name "Tên Của Bạn"
git config --global user.email "email@example.com"
git config --global init.defaultBranch main  # Đặt nhánh mặc định là main
```

Kiểm tra cấu hình:

```bash
git config --list
```

---

---

Clone về máy

```jsx
git clone https://github.com/username/repository.git
```

Tạo local trước rồi push lên GitHub

```bash
# mkdir my-project
# cd my-project
git init
git remote add origin <https://github.com/username/repository.git>
```

Các lệnh cơ bản

```bash
git status                      # Xem trạng thái các file
git add .                       # Thêm tất cả thay đổi vào staging area
git add <filename>              # Thêm file cụ thể
git commit -m "Message"         # Tạo commit với thông điệp
git push origin <branch-name>   # Đẩy code lên GitHub
git pull <origin branch-name>   # Lấy code mới nhất từ remote
git log
```

## **Phần 2: Trung cấp**

**1. Làm việc với branches (nhánh)**

```bash
git branch                  # Liệt kê các nhánh
git branch new-branch       # Tạo nhánh mới
git checkout branch-name    # Chuyển sang nhánh
git checkout -b new-branch  # Tạo và chuyển sang nhánh mới
git merge branch-name       # Gộp nhánh vào nhánh hiện tại
git branch -d branch-name   # Xóa nhánh local
```
