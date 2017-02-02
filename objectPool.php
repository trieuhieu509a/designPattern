Performance có thể đôi khi cũng là vấn đề lớn trong việc phát triển phần mềm và việc tạo ra object là một step cần phải được cân nhắc. Trong khi prototype pattern giúp cho việc cải thiện performance bằng cách cloning object, Object pool pattern cung cấp một kỹ thuật để tái sử dụng objects thay vì khởi tạo không kiểm soát.

Vậy mục đích của object pool pattern là gì?

- Tái sử dụng và share objects cần sử dụng thay vì khởi tạo không kiểm soát.

Implementation object pool pattern thế nào?

<img src="./objectPool.gif">

Object pool pattern

Việc triển khai object pool pattern sẽ bao gồm những object sau:

Reusable - là một wraps class limited,sẽ được share bởi một số client với việc giới hạn time.
Client - sử dụng instance của (1)
ReusablePool - quản lý những object của (1) được sử dụng ở (2), khởi tạo và quản lý một pool của tất cả object.

Khi một client yêu cầu sử dụng một Reusable object, ReusablePool sẽ thực hiện những bước bên dưới đây:

Tìm kiếm một Reusable có sẵn và nếu nó đã tồn tại thì sẽ được trả về cho client
Nếu không tồn tại, nó sẽ tạo ra một object. Nếu step này thành công, Reusable object mới tạo sẽ được trả về cho client.
Trong trường hợp ReusablePool không thể khởi tạo được object, no sẽ trờ cho đến khi một Reusable object được released.

Tại sao sử dụng nó?

Về cơ bản, bạn sẽ sử dụng một "object pool" bất cứ khi nào có một "client" có nhu cầu sử dụng tương tự thay vì khởi tạo một object mới không có kiểm soát.

Sử dụng ở đâu?

Ví dụ về một connection tới database chẳng hạn, Nếu có quá nhiều kết nối đến database được tạo ra sẽ ảnh hưởng rất performance, và có thể db server sẽ overload. Ngoài ra, sẽ thường xảy ra các exception liên quan đến business. Do đó, việc sử dụng cả object pool pattern và singleton pattern cho tình huống này là một sự lựa chọn tinh tế.

Kết luận

Để nâng cao performance của hệ thống, việc khởi tạo object cần phải được cân nhắc một cách kỹ lưỡng và sử dụng object pool pattern hợp lý sẽ là một giải pháp tuyệt vời cho bạn. Trong bài tiếp theo, tôi sẽ trình bày việc sử dụng object pool pattern trong ngôn ngữ java.