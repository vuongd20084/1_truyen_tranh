<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <!-- Nhúng file quản lý phần HEAD -->
  <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
</head>

<body class="d-flex flex-column h-100">
  <!-- header -->
  <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
  <!-- end header -->

  <div class="container-fluid">
    <div class="row">
      <!-- sidebar -->
      <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
      <!-- end sidebar -->

      <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Danh sách hình sản phẩm</h1>
        </div>

        <!-- Block content -->
        <?php
        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__. '/../../../dbconnect.php');

        // 2. Chuẩn bị câu truy vấn $sql
        $stt=1;
        $sql = "SELECT hsp_ma, hsp_tentaptin, sp_ma	FROM hinhsanpham;";

        // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
        $result = mysqli_query($conn, $sql);
        // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
        $ds_hinhsanpham = [];
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
          $ds_hinhsanpham[] = array(
            'hsp_ma' => $row['hsp_ma'],
            'hsp_tentaptin' => $row['hsp_tentaptin'],
            'sp_ma' => $row['sp_ma']
          );
        }
        ?>

        <!-- Nút thêm mới, bấm vào sẽ hiển thị form nhập thông tin Thêm mới -->
        <a href="create.php" class="btn btn-primary">Thêm mới</a>
        <table class="table table-bordered table-hover mt-2">
          <thead class="thead-dark">
          <tr>
              <th>STT</th>
              <th>Mã hình sản phẩm</th>
              <th>Tên tập tin hình sản phẩm</th>
              <th>Mã sản phẩm</th>
              <th>Hành động</th>
          </tr>
          </thead>
          <tbody>
            <?php
              foreach ($ds_hinhsanpham as $hsp):?>
                <tr>
                  <td><?= $stt; $stt++?></td>
                  <td><?= $hsp['hsp_ma']?></td>
                  <td><?= $hsp['hsp_tentaptin']?></td>
                  <td><?= $hsp['sp_ma']?></td>
                  <td>
                    <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `hsp_ma` -->
                    <a href="edit.php?hsp_ma=<?= $hsp['hsp_ma'] ?>" class="btn btn-warning">
                      <span data-feather="edit"></span> Sửa
                    </a>
                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `hsp_ma` -->
                    <a href="delete.php?hsp_ma=<?= $hsp['hsp_ma'] ?>" class="btn btn-danger">
                      <span data-feather="delete"></span> Xóa
                    </a>
                  </td>
                  
                </tr>
              <?php endforeach ?>
          </tbody>
        
        </table>
        <!-- End block content -->
      </main>
    </div>
  </div>

  <!-- footer -->
  <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
  <!-- end footer -->

  <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
  <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

  <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
  <!-- <script src="..."></script> -->
</body>

</html>