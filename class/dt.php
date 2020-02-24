<?php
require_once "goc.php";
class dt extends goc
{
    function Blog($sotin)
    {
        $sql = "SELECT idTin, TieuDe, TomTat,urlHinh FROM tin  WHERE AnHien = 1 
        ORDER BY RAND() LIMIT 0,$sotin";
        $kq = $this->db->query($sql);
        if (!$kq) die('Lỗi trong hàm' . __FUNCTION__ . '' . $this->db->error);
        return $kq;
    } //end function Blog
    function SanPhamMoi($sosp = 10)
    {
        $sql = "SELECT idDT, TenDT, urlHinh,Gia FROM dienthoai  WHERE AnHien = 1 
        ORDER BY NgayCapNhat DESC LIMIT 0,$sosp";
        $kq = $this->db->query($sql);
        if (!$kq) die('Lỗi trong hàm' . __FUNCTION__ . '' . $this->db->error);
        return $kq;
    } //end function SanPhamMoi

    function ListLoaiSP()
    {
        $sql = "SELECT idLoai, TenLoai, hinh FROM loaisp  WHERE AnHien = 1
        ORDER BY ThuTu DESC LIMIT 0,12";
        $kq = $this->db->query($sql);
        if (!$kq) die('Lỗi trong hàm' . __FUNCTION__ . '' . $this->db->error);
        return $kq;
    } //end function ListLoaiSP

    function SanPhamBanChay($sosp = 10)
    {
        $sql = "SELECT idDT, TenDT, urlHinh,Gia FROM dienthoai  WHERE AnHien = 1 
        ORDER BY SoLanMua DESC LIMIT 0,$sosp";
        $kq = $this->db->query($sql);
        if (!$kq) die('Lỗi trong hàm' . __FUNCTION__ . '' . $this->db->error);
        return $kq;
    } //end function SanPhamBanChay

    function SanPhamHot($sosp = 10)
    {
        $sql = "SELECT idDT, TenDT, urlHinh,Gia FROM dienthoai  WHERE AnHien = 1 
        AND Hot=1
        ORDER BY NgayCapNhat DESC LIMIT 0,$sosp";
        $kq = $this->db->query($sql);
        if (!$kq) die('Lỗi trong hàm' . __FUNCTION__ . '' . $this->db->error);
        return $kq;
    } //end function SanPhamHot

    function CapNhatGioHang($action, $idDT)
    {
        if (!isset($_SESSION['daySoLuong']))
            $_SESSION['daySoLuong'] = array();
        if (!isset($_SESSION['dayDonGia']))
            $_SESSION['dayDonGia'] = array();
        if (!isset($_SESSION['dayTenDT']))
            $_SESSION['dayTenDT'] = array();
        if (!isset($_SESSION['dayHinh']))
            $_SESSION['dayHinh'] = array();
        if ($action == 'add') {
            settype($idDT, "int");
            if ($idDT <= 0) return;
            $sql = "SELECT TenDT,Gia,SoLuongTonKho,urlHinh
            FROM dienthoai 
            WHERE idDT =$idDT";
            $kq = $this->db->query($sql);
            if (!$kq) die('Lỗi trong hàm' . __FUNCTION__ . '' . $this->db->error);
            $row = $kq->fetch_assoc();

            $_SESSION['dayTenDT'][$idDT] = $row['TenDT'];
            $_SESSION['dayDonGia'][$idDT] = $row['Gia'];
            $_SESSION['dayHinh'][$idDT] = $row['urlHinh'];
            $_SESSION['daySoLuong'][$idDT] += 1;
            $_SESSION['alerAddCart'] = true;

            if ($_SESSION['daySoLuong'][$idDT] > $row['SoLuongTonKho'])
                $_SESSION['daySoLuong'][$idDT] = $row['SoLuongTonKho'];
        } //add

        if ($action == 'remove') {
            settype($idDT, "int");
            if ($idDT <= 0) return;
            unset($_SESSION['dayTenDT'][$idDT]);
            unset($_SESSION['dayDonGia'][$idDT]);
            unset($_SESSION['daySoLuong'][$idDT]);
            unset($_SESSION['dayHinh'][$idDT]);
        } //remove
        if ($action == 'update') {
            $iddt_arr = $_POST['iddt_arr'];
            $soluong_arr = $_POST['soluong_arr'];
            for ($i = 0; $i < count($iddt_arr); $i++) {
                $idDT = $iddt_arr[$i];
                settype($idDT, "int");
                if ($idDT <= 0) continue;
                $soluong = $soluong_arr[$i];
                settype($soluong, "int");
                if ($soluong < 0) continue;
                $kq = $this->chiTietSP($idDT);
                $row = $kq->fetch_assoc();
                $_SESSION['dayTenDT'][$idDT] = $row['TenDT'];
                $_SESSION['dayDonGia'][$idDT] = $row['Gia'];
                $_SESSION['dayHinh'][$idDT] = $row['urlHinh'];
                $_SESSION['daySoLuong'][$idDT] = $soluong;

                if ($_SESSION['daySoLuong'][$idDT] > $row['SoLuongTonKho'])
                    $_SESSION['daySoLuong'][$idDT] = $row['SoLuongTonKho'];
            } //for
        } //update
    } //end  function CapNhatGioHang

    function chiTietSP($idDT)
    {
        $sql = "SELECT * FROM dienthoai WHERE AnHien = 1 AND idDT=$idDT";
        $kq = $this->db->query($sql);
        if (!$kq) die($this->db->error);
        return $kq;
    } //end function chiTietSP

    function LuuDonHang(&$error)
    {
        $hoten = $this->db->escape_string(trim(strip_tags($_SESSION['DonHang']['hoten'])));
        $dienthoai = $this->db->escape_string(trim(strip_tags($_SESSION['DonHang']['dienthoai'])));
        $diachi = $this->db->escape_string(trim(strip_tags($_SESSION['DonHang']['diachi'])));
        $email = $this->db->escape_string(trim(strip_tags($_SESSION['DonHang']['email'])));
        $pttt = $this->db->escape_string(trim(strip_tags($_SESSION['DonHang']['payment'])));
        $ptgh = $this->db->escape_string(trim(strip_tags($_SESSION['DonHang']['delivery'])));

        //kiểm tra dữ liệu
        if (count($_SESSION['daySoLuong']) == 0) $error[] = "Bạn chưa chọn sản phẩm nào cả";
        if ($hoten == "") $error[] = "Bạn chưa nhập họ tên";
        if ($diachi == "") $error[] = "Bạn chưa nhập địa chỉ";
        if ($email == "") $error[] = "Bạn chưa nhập email";
        if ($dienthoai == "") $error[] = "Bạn chưa nhập điên thoại";
        if ($pttt == "") $error[] = "Bạn chưa chọn phương thức thanh toán";
        if ($ptgh == "") $error[] = "Bạn chưa chọn phương thức giao hàng";
        // if (isset($_SESSION['login_id']) == false) $error[] = "Bạn chưa login, vui long login trc khi mua";
        //lưu dữ liệu vào db
        if (isset($_SESSION['DonHang']['idDH']) == false) {
            $sql = "INSERT INTO donhang 
            SET tennguoinhan='$hoten',
            diachi='$diachi',
            dtnguoinhan='$dienthoai',
            idpttt='$pttt',
            idptgh='$ptgh',
            email='$email',
            thoidiemdathang= now() ";
            $kq = $this->db->query($sql);
            if (!$kq) die($this->db->error);
            $_SESSION['DonHang']['idDH'] = $this->db->insert_id;
        } else {
            $idDH = $_SESSION['DonHang']['idDH'];
            $sql = "UPDATE donhang 
            SET tennguoinhan ='$hoten',
            diachi='$diachi',
            dtnguoinhan='$dienthoai',
            idpttt='$pttt',
            idptgh='$ptgh',
            email='$email',
            thoidiemdathang= now()
            WHERE idDH= $idDH ";
            $kq = $this->db->query($sql);
            if (!$kq) die($this->db->error);
        }
    } //end function LuuDonHang

    function LuuChiTietDonHang()
    {
        $sosp = count($_SESSION['daySoLuong']);
        if ($sosp <= 0) {
            echo "Không có sản phẩm";
            return;
        }
        if (isset($_SESSION['DonHang']['idDH']) == false) {
            echo "Không có idDH";
            return;
        }
        $idDH = $_SESSION['DonHang']['idDH'];
        $sql = "DELETE FROM donhangchitiet WHERE idDH= $idDH";
        $this->db->query($sql);
        reset($_SESSION['daySoLuong']);
        reset($_SESSION['dayDonGia']);
        reset($_SESSION['dayTenDT']);

        for ($i = 0; $i < $sosp; $i++) {

            $idDT = key($_SESSION['daySoLuong']);
            $tendt = current($_SESSION['dayTenDT']);
            $soluong = current($_SESSION['daySoLuong']);
            $gia = current($_SESSION['dayDonGia']);
            $sql = "INSERT INTO donhangchitiet (idDH,idDT,TenDT,SoLuong,Gia)
             VALUES ($idDH,$idDT,'$tendt',$soluong,$gia)";
            $this->db->query($sql);

            next($_SESSION['daySoLuong']);
            next($_SESSION['dayDonGia']);
            next($_SESSION['dayTenDT']);
        } //for
    } //end function LuuChiTietDonHang

    //=================================================

    function SanPhamTrongLoai($TenLoai, $pageNum, $pageSize, &$totalRows)
    {
        $TenLoai = $this->db->escape_string($TenLoai);
        $startRow = ($pageNum - 1) * $pageSize;
        $sql = "SELECT idDT, TenDT, urlHinh ,Gia
        FROM dienthoai
        WHERE AnHien=1
        AND idLoai in (SELECT idLoai
        FROM loaisp
        WHERE TenLoai='$TenLoai')
        ORDER BY NgayCapNhat DESC 
        LIMIT $startRow,$pageSize";
        $kq = $this->db->query($sql);
        if (!$kq) die($this->db->error);

        $sql = "SELECT count(*) 
        FROM dienthoai 
        WHERE AnHien =1
        AND idLoai in (SELECT idLoai
        FROM loaisp
        WHERE TenLoai='$TenLoai')";
        $rs = $this->db->query($sql);
        $row_rs = $rs->fetch_row();
        $totalRows = $row_rs[0];
        if (!$kq) die($this->db->error);
        return $kq;
    } //end  function SanPhamTrongLoai

    function pagesList1($baseURL, $totalRows, $pageNum, $pageSize, $offset)
    {
        if ($totalRows <= 0) return "";
        $totalPages = ceil($totalRows / $pageSize);
        if ($totalPages <= 1) return "";
        $from = $pageNum - $offset;
        $to = $pageNum + $offset;
        if ($from <= 0) {
            $from = 1;
            $to = $offset * 2;
        }
        if ($to > $totalPages) {
            $to = $totalPages;
        }
        $links = "<ul class='pagination'>";
        for ($j = $from; $j <= $to; $j++) {
            if ($j == $pageNum)
                $links = $links . "<li class='active'><a href='$baseURL/$j/' >$j</a></li>";
            else
                $links = $links . "<li><a href='$baseURL/$j/'>$j</a></li>";
        } //for
        $links = $links . "</ul>";
        return $links;
    } //end  function pagesList1

    function Tintuc($pageNum, $pageSize, &$totalRows)
    {
        $startRow = ($pageNum - 1) * $pageSize;
        $sql = "SELECT idTin, TieuDe, TomTat,urlHinh FROM tin  WHERE AnHien = 1 
        ORDER BY RAND() LIMIT $startRow,$pageSize";
        $kq = $this->db->query($sql);
        if (!$kq) die('Lỗi trong hàm' . __FUNCTION__ . '' . $this->db->error);


        $sql = "SELECT count(*) FROM tin  WHERE AnHien = 1 ";
        $rs = $this->db->query($sql);
        $row_rs = $rs->fetch_row();
        $totalRows = $row_rs[0];
        if (!$kq) die($this->db->error);
        return $kq;
    } //end function Tintuc


    function layHinhSP($idDT, $sohinh)
    {
        $sql = "SELECT urlHinh 
        FROM hinh
        WHERE AnHien = 1 
        AND idDT=$idDT
        LIMIT 0,$sohinh";
        $kq = $this->db->query($sql);
        if (!$kq) die($this->db->error);
        return $kq;
    } //end function layHinhSP

    function GuiMail($to, $from, $from_name, $subject, $body, $username, $password, &$error)
    {

        $error = "";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/banhang/PHPMailer-master/class.phpmailer.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/banhang/PHPMailer-master/class.smtp.php";

        try {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;  //  1=errors and messages, 2=messages only
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SetFrom($from, $from_name);
            $mail->Subject = $subject;
            $mail->MsgHTML($body); // noi dung chinh cua mail
            $mail->addAddress($to);
            $mail->CharSet = "utf-8";
            $mail->IsHTML(true);
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            if (!$mail->Send()) {
                $error = 'Loi:' . $mail->ErrorInfo;
                return false;
            } else {
                $error = '';
                return true;
            }
        } catch (phpmailerException $e) {
            echo "<pre>" . $e->errorMessage();
        }
    } //end function GuiMail

    function DangKyThanhVien(&$loi)
    {
        $thanhcong = true;
        // tiếp nhận dữ liệu từ form
        $email = $this->db->escape_string(trim(strip_tags($_POST['mail'])));
        $pass = $this->db->escape_string(trim(strip_tags($_POST['pass'])));
        $repass = $this->db->escape_string(trim(strip_tags($_POST['repass'])));
        $ht = $this->db->escape_string(trim(strip_tags($_POST['ht'])));
        $dc = $this->db->escape_string(trim(strip_tags($_POST['dc'])));
        $dt = $this->db->escape_string(trim(strip_tags($_POST['dt'])));
        $p = isset($_POST['phai']) ? $_POST['phai'] : '';
        settype($p, "int");
        //kt du lieu 

        //kt email
        if ($email == null) {
            $thanhcong = false;
            $loi['email'] = "You have not entered email address";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $thanhcong = false;
            $loi['email'] = "You entered the wrong email";
        } elseif ($this->CheckEmail($email) == false) {
            $thanhcong = false;
            $loi['email'] = "This email already has users";
        }

        // kt pass and retype password
        if ($pass == null) {
            $thanhcong = false;
            $loi['pass'] = "You have not entered password";
        } elseif (strlen($pass) < 6 || strlen($pass) > 30) {
            $thanhcong = false;
            $loi['pass'] = "Your password must be between 6 and 30 characters";
        }
        if ($repass == null) {
            $thanhcong = false;
            $loi['repass'] = "You have not entered repassword";
        } elseif ($pass != $repass) {
            $thanhcong = false;
            $loi['repass'] = "2nd password not like 1st";
        }

        // kt ho ten
        if ($ht == null) {
            $thanhcong = false;
            $loi['hoten'] = "You have not entered name";
        }

        // kt dia chi
        if ($dc == null) {
            $thanhcong = false;
            $loi['diachi'] = "You have not entered address";
        }

        // kt dien thoai
        if ($dt == null) {
            $thanhcong = false;
            $loi['dienthoai'] = "You have not entered phone";
        } elseif (is_numeric($dt) == false) {
            $thanhcong = false;
            $loi['dienthoai'] = "You entered the wrong phone";
        }

        //insert into database
        if ($thanhcong == true) {
            $mahoa = md5($pass);
            $rd = md5(rand(1, 99999));
            $sql = "INSERT INTO users 
            SET  email ='$email' ,
            password='$mahoa',
            hoten='$ht',
            diachi='$dc',
            dienthoai='$dt',
            gioitinh=$p,
            active=0,
            randomkey='$rd', 
            ngaydangky=NOW()";
            $kq = $this->db->query($sql);
        }

        $id = $this->db->insert_id;
        $subject = "Activate account";
        $content = file_get_contents("dangky_thukichhoat.html");
        $link = "http://" . $_SERVER['SERVER_NAME'] . "/banhang/kich-hoat/$id/$rd";
        $noidungthu = str_replace(
            array("{email}", "{matkhau}", "{hoten}", "{link}"),
            array($email, $pass, $ht, $link),
            $content
        );
        $from = "nghnhanbrvt@gmail.com"; // dung mail test, ko dung` mail chinh thuc
        $p = "pxriedhtjmtrsnrr";
        $this->GuiMail($email, $from, $ten = "BQT Shop Telephone", $subject, $noidungthu, $from, $p, $error);
        if ($error != null) $loi['guimail'] = $error;
        return $thanhcong;
    } // end function DangKyThanhVien

    function CheckEmail($email)
    {
        $sql = "SELECT idUser
        FROM users 
        WHERE email='$email'";
        $kq = $this->db->query($sql);
        if ($kq->num_rows > 0) return false;
        else return true;
    } //end function CheckEmail
    function DanhDauKichHoatUser($id, $rd)
    {
        $sql = "UPDATE users 
        SET active=1
        WHERE idUser=$id
        AND randomkey='$rd'
        AND active=0";
        $kq = $this->db->query($sql);
        return $this->db->affected_rows;
    } //end function DanhDauKichHoatUser
    function login($email, $p, &$loi)
    {
        $loi = array();
        $email = $this->db->escape_string(trim(strip_tags($email)));
        $p = $this->db->escape_string(trim(strip_tags($p)));
        $p_mahoa = md5($p);

        $sql = "SELECT * 
        FROM users 
        WHERE email='$email'";
        $kq = $this->db->query($sql);
        if ($kq->num_rows == 0) {
            $loi['mail'] = "<span class='label label-warning'>Email không có</span>";
            return FALSE;
        }
        $sql = "SELECT * 
        FROM users 
        WHERE email='$email'
        AND password='$p_mahoa'";
        $kq = $this->db->query($sql);
        if ($kq->num_rows == 0) {
            $loi['pass'] = "<span class='label label-danger'>Password không đúng</span>";
            return FALSE;
        }
        $row = $kq->fetch_assoc();
        $_SESSION['login_id'] = $row['idUser'];
        $_SESSION['login_hoten'] = $row['HoTen'];
        $_SESSION['login_email'] = $row['Email'];
        return TRUE;
    } //end function login

    function checkLogin()
    {
        if (isset($_SESSION['login_id']) == false) {
            $_SESSION['error'] = 'Bạn chưa đăng nhập';
            $_SESSION['back'] = $_SERVER['REQUEST_URI'];
            header('location:login.php');
            exit();
        }
    } //end function checkLogin

    function DoiMatKhau($passold, $pass, $repass, &$loi)
    {
        $thanhcong = true;
        $passold = $this->db->escape_string(trim(strip_tags($passold)));
        $pass = $this->db->escape_string(trim(strip_tags($pass)));
        $repass = $this->db->escape_string(trim(strip_tags($repass)));
        $idUser = $_SESSION['login_id'];
        // kiem tra du lieu nhap

        if ($passold == null) {
            $thanhcong = false;
            $loi[] = 'You have not entered old password';
        } else {
            $sql = "SELECT *
            FROM users
            WHERE idUser=$idUser
            AND password=md5('$passold')";
            $rs = $this->db->query($sql);
            if ($rs->num_rows == 0) {
                $thanhcong = false;
                $loi[] = 'Your old password is wrong';
            }
        }
        if ($pass == null) {
            $thanhcong = false;
            $loi[] = 'You have not entered new password';
        } elseif (strlen($pass) < 6) {
            $thanhcong = false;
            $loi[] = 'New password too short. Must be >= 6 characters';
        } elseif ($pass != $repass) {
            $thanhcong = false;
            $loi[] = '2 times the password is not the same';
        }
        if ($thanhcong == true) {
            //update new pass
            $sql = "UPDATE users
            SET password=md5('$pass')
            WHERE idUser= $idUser";
            $this->db->query($sql);
        }
        return $thanhcong;
    } // end function DoiMatKhau

    function GoiPass($email, &$loi)
    {
        $thanhcong = true;
        $loi = array();
        $email = $this->db->escape_string(trim(strip_tags($email)));
        $passnew = "";
        if ($email == null) {
            $thanhcong = false;
            $loi[] = "You have not entered email address";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $thanhcong = false;
            $loi[] = "You entered the wrong email";
        } else {
            $sql = "SELECT idUser
        FROM users 
        WHERE email='$email'";
            $kq = $this->db->query($sql);
            if ($kq->num_rows == 0) {
                $thanhcong = false;
                $loi[] = "Not have this email";
            }
        }

        if ($thanhcong == true) {
            $passnew = substr(md5(rand(0, 9999)), 0, 6);
            $sql = "UPDATE users SET password=md5('$passnew') WHERE email='$email'";
            $kq = $this->db->query($sql);
            if (!$kq) die($this->db->error);
        }

        $subject = "Reset Password";
        $noidungthu = "Your new Password is:" . $passnew;
        $from = "nghnhanbrvt@gmail.com"; // dung mail test, ko dung` mail chinh thuc
        $p = "pxriedhtjmtrsnrr";
        $this->GuiMail($email, $from, $ten = "BQT Shop Telephone", $subject, $noidungthu, $from, $p, $error);
        if ($error != null) $loi['guimail'] = $error;

        return $thanhcong;
    } // end  function GoiPass

    function LayDonHang($hoadon)
    {
        settype($hoadon, "int");
        $sql = "SELECT * FROM donhang
        WHERE idDH='$hoadon'";
        $kq = $this->db->query($sql);
        if (!$kq) die($this->db->error);
        return $kq;
    } //end function LayDonHang

    function LayDonHangCT($idDH)
    {
        settype($idDH, "int");
        $sql = "SELECT * FROM donhangchitiet
        WHERE idDH='$idDH'";
        $kq = $this->db->query($sql);
        if (!$kq) die($this->db->error);
        return $kq;
    } //end function LayDonHang

    function GuiMailCoFilePDF($file, $mailto)
    {

        require $_SERVER['DOCUMENT_ROOT'] . "/banhang/PHPMailer-master_moi/functions.php";
        $title = 'Hướng dẫn gửi mail bằng phpmailer';
        $content = 'Bạn đang tìm hiểu về cách gửi mail bằng php mailer trên';
        $nTo = 'BQT Shop';

        $mail = sendMailAttachment($title, $content, $nTo, $mailto, $diachicc = '', $file, 'Đây là file đính kèm');
    } //end function GuiMailCoFilePDF
    function LayidDT($TenDT)
    {
        $TenDT = trim(strip_tags($_GET['TenDT']));
        $TenDT = $this->db->escape_string($TenDT);
        $TenDT = str_replace('-', ' ', $TenDT);
        $sql = "SELECT idDT FROM dienthoai WHERE TenDT='$TenDT'";
        $kq = $this->db->query($sql);
        $row_kq = $kq->fetch_assoc();
        return $row_kq['idDT'];
    } //end function LayidDT

    function TimKiem($TuKhoa, $pageNum, $pageSize, &$totalRows)
    {
        $TuKhoa = $this->db->escape_string($TuKhoa);
        $startRow = ($pageNum - 1) * $pageSize;
        $sql = "SELECT idDT, TenDT, urlHinh ,Gia ,MoTa
        FROM dienthoai
        WHERE AnHien=1
        AND (TenDT RegExp '$TuKhoa' or MoTa RegExp '$TuKhoa')
        ORDER BY NgayCapNhat DESC 
        LIMIT $startRow,$pageSize";
        $kq = $this->db->query($sql);
        if (!$kq) die($this->db->error);

        $sql = "SELECT count(*) 
        FROM dienthoai
        WHERE AnHien=1
        AND (TenDT RegExp '$TuKhoa' or MoTa RegExp '$TuKhoa')";
        $rs = $this->db->query($sql);
        $row_rs = $rs->fetch_row();
        $totalRows = $row_rs[0];
        if (!$kq) die($this->db->error);
        return $kq;
    } //end  function TimKiem
}//dt
