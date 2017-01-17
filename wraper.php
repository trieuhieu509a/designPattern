<?php

    /* Wrapper Pattern là gì?
     * Wrapper Pattern là một trường hợp đặc biệt của Adapter Pattern.
     * Nếu một Adapter chỉ đơn thuần là "nhúng" (wrap) các lớp với các giao diện không tương thích với nhau để chúng có thể hoạt động cùng nhau thì có thể được gọi bằng tên riêng Wrapper Pattern.
     * Khi đó lớp Adapter còn được gọi là lớp Wrapper.
     * Đây là quan hệ "có một", tức là một giao diện không tương thích có thể được nhúng vào thành một phần của một giao diện khác.
     *
     * Đặc điểm
      Đối tượng Wrapper mô phỏng tất cả các hành vi (hàm, thủ tục) của giao diện được nhúng bởi các hành vi với tên y hệt.
      Thí dụ nếu lớp được nhúng A có thủ tục SpecificRequest() thì lớp Wrapper cũng phải có thủ tục SpecificRequest() tham chiếu đến thủ tục cùng tên của A.
      (Ngoài ra đối tượng Wraper có thể được bổ sung các phương thức khác nếu cần thiết).
      Đặc điểm này được đưa ra dựa trên nguyên tắc thiết kế "Law of Demeter" nói rằng không nên tham chiếu một đối tượng sâu hơn một lớp.
      Các phương thức trong Adaptee được "nhúng" trong Wrapper bằng cách truyền lời gọi cùng với các tham số tới phương thức tương ứng trong Adaptee, và trả về kết quả giống như vậy.
      Các thành viên (thuộc tính, trường, sự kiện) được nhúng trong Wrapper có tính chất giống hệt như trong các lớp được nhúng (tên, kiểu dữ liệu, phạm vi truy cập...).
      Từ các đặc điểm ở trên, có thể thấy rằng Wrapper Pattern cho phép một module chương trình tương tác được trong một môi trường khác biệt với môi trường phát triển của module đó (ví dụ C++ và Java).
      Khác biệt giữa Wrapper Pattern và Adapter Pattern
      Sự khác biệt giữa Wrapper và Adapter nằm ở mục đích sử dụng: Adapter Pattern định hướng cho một đối tượng đang tồn tại có thể làm việc được với các đối tượng khác và biến đổi logic theo một cách thức nào đó,
      trong khi Wrapper Pattern chỉ đơn thuần cung cấp một giao diện kết hợp các đối tượng được xây dựng từ cùng một ngôn ngữ hoặc khác ngôn ngữ, trên cùng một hệ điều hành hoặc trên những hệ điều hành khác nhau.
     */
?>