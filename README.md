# RestAPI Homework
- Dự án nhỏ cho xử lý bên Back-End bài tập về nhà của nhóm tôi.
- Framework sử dụng: ``Slim 4``

# Lưu ý
- Các controllers của nhóm làm bên data-folder hiện tại chưa chính thức ghi đè vào dự án này vì có cập nhật nữa.

# Mục đích
- Dự án tạo ra để làm việc xử lý router xử lý các truy vấn từ database và cả security cho phần mềm.
- Phần làm bài ở các `Controllers` và `Middlewares`

# Các thư viện có trong phần mềm
- Các thư viện Composer:
```json
    "require": {
        "slim/slim": "*", //framework xử lý các router cho phần mềm
        "slim/http": "^1.3", //framework xử lý các router cho phần mềm
        "slim/psr7": "^1.6", //framework xử lý các router cho phần mềm
        "doctrine/annotations": "^2.0", //thư viện hỗ trợ các annotations
        "vennv/vapm": "^1.8", //thư viện bổ sung từ tôi nhằm hỗ trợ async cho php
        "symfony/yaml": "^7.0", //thư viện support đọc các file dạng yaml
        "ramsey/uuid": "^4.7" //thư viện xử lý uuid
    }
```
- Ngoài ra còn các thư viện bổ sung trong phần folder nhằm hữu dụng cho việc truy vấn database và các thứ khác.

# Cách cài đặt
- Yêu cầu phiên bản ``PHP`` từ ``8.2`` trở lên!
- Đầu tiên cần dữ liệu database đã có trên nhóm.
- Cài đặt [Composer](https://getcomposer.org/Composer-Setup.exe)
- Sau đó bật ``Command Prompt`` tại đường dẫn mà dự án của mấy ông đã tải
- Gõ lệnh `composer update`
- Sửa cấu hình database sao cho phù hợp ở trong file này [Click Here](https://github.com/VennDev/RestAPI---Homework/blob/main/resources/config.yml)
- Sau đó chỉ cần chạy file `start.cmd`

# Các phương thức để sử dụng và làm bài
- Phần làm bài ở các `Controllers` và `Middlewares`
- Middlewares đóng vai trò giống Filter trong TOMCAT mà các bạn hay làm
- Controllers gần giống với Servlet mà các bạn hay làm trong TOMCAT
- Các phương thức có thể nghiên cứu qua [Click Here](https://www.slimframework.com/docs/v4/)
- Trong đó việc sử dụng các phương thức của `LINK` kia qua hàm ở đây [Click Here](https://github.com/VennDev/RestAPI---Homework/blob/main/src/venndev/index.php#L9)
- Tôi có code các mẫu ở sẵn 2 mẫu sẵn các bạn coi không hiểu hỏi tôi nhé!
- Controller mẫu [Click Here](https://github.com/VennDev/RestAPI---Homework/tree/main/src/venndev/controllers)
- Middleware mẫu [Click Here](https://github.com/VennDev/RestAPI---Homework/tree/main/src/venndev/middlewares)
- Nếu cần một mẫu truy vấn cở sở dữ liệu thì ở đây [Click Here](https://github.com/VennDev/RestAPI---Homework/blob/main/src/venndev/controllers/HelloNam.php#L34)

# Thử nghiệm
- Khi mà code xong các controllers và middlewares các bạn có thể test với file `test.php` tôi có để trong src này!
- Lưu ý: phải sửa lại code trong file `test.php` để phù hợp với thứ các bạn code để test thử url
- Ví dụ gõ lệnh: `php test.php`
- Ngoài ra có thể thử nghiệm trên các trình duyệt website thông thường qua việc gõ đường link `http://localhost:8080/your_router`
- Hoặc bạn có thể test data qua PostMan
