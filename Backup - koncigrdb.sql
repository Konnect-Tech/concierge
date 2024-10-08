-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 23-09-27 17:08
-- 서버 버전: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP 버전: 7.2.24-0ubuntu0.18.04.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `koncigrdb`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `buy_history_info`
--

CREATE TABLE `buy_history_info` (
  `idx` int(11) NOT NULL AUTO_INCREMNET PRIMARY KEY COMMENT 'PK',
  `currency_idx` int(11) NOT NULL COMMENT 'currency_info PK',
  `type` tinyint(1) NOT NULL COMMENT '구매내역 구분 (0: 면세점/1: 메디컬)',
  `subject` varchar(100) NOT NULL COMMENT '제목',
  `gubun` varchar(100) NOT NULL COMMENT '시술명 또는 온라인/오프라인',
  `date` datetime DEFAULT NULL COMMENT '날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='구매내역 테이블';

--
-- 테이블의 덤프 데이터 `buy_history_info`
--

INSERT INTO `buy_history_info` (`idx`, `currency_idx`, `type`, `subject`, `gubun`, `date`) VALUES
(1, 5, 0, '신라면세점 ON', '온라인', NULL),
(2, 6, 0, '신라면세점 OFF', '오프라인', NULL),
(3, 7, 0, '신라면세점 ON', '온라인', NULL),
(4, 8, 0, '신라면세점 ON', '온라인', NULL),
(5, 11, 1, '테스트 지급', '돌파리치과', '2023-09-12 13:44:00'),
(6, 13, 0, '집가고싶다', '오프라인', NULL),
(7, 14, 1, '시술이름', '돌파리병원', '2023-09-12 16:52:00'),
(8, 15, 0, '테스트 D 지급', '온라인', NULL),
(9, 16, 0, '면세점1', '온라인', NULL),
(10, 19, 0, '면세점2', '온라인', NULL),
(11, 24, 1, '메디컬1', '호산여성병원', '2023-09-05 14:36:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `currency_info`
--

CREATE TABLE `currency_info` (
  `idx` int(11) NOT NULL COMMENT 'PK',
  `member_idx` int(11) NOT NULL COMMENT 'member_info PK',
  `source` varchar(60) NOT NULL COMMENT '출처',
  `currency` varchar(30) NOT NULL COMMENT '통화',
  `amount` int(11) NOT NULL COMMENT '수량',
  `wdate` datetime NOT NULL COMMENT '등록일',
  `etc` varchar(150) NOT NULL DEFAULT '0' COMMENT '기타'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='재화 테이블';

--
-- 테이블의 덤프 데이터 `currency_info`
--

INSERT INTO `currency_info` (`idx`, `member_idx`, `source`, `currency`, `amount`, `wdate`, `etc`) VALUES
(8, 3, '신라면세점 ON', '원', 165000, '2023-09-07 13:32:54', '0'),
(9, 3, '테스트 M 지급', 'M', 550, '2023-09-07 13:44:24', '0'),
(10, 3, '테스트 D 지급', 'D', 1650, '2023-09-07 13:44:33', '0'),
(11, 3, '테스트 지급', '원', 1500, '2023-09-07 13:45:35', '0'),
(12, 3, '테스트 일부 차감', 'M', -500, '2023-09-07 16:23:34', '0'),
(13, 3, '집가고싶다', '원', 99999, '2023-09-07 16:49:20', '0'),
(14, 3, '시술이름', '원', 1000000, '2023-09-07 16:52:31', '0'),
(15, 3, '테스트 D 지급', '원', 1, '2023-09-13 10:51:29', '0'),
(16, 4, '면세점1', '원', 100000, '2023-09-20 14:39:34', '0'),
(17, 4, '지급 테스트1', 'D', 1000, '2023-09-20 14:41:37', '0'),
(18, 4, '차감 테스트', 'D', -500, '2023-09-20 14:41:45', '0'),
(19, 4, '면세점2', '원', 50000, '2023-09-20 14:46:24', '0'),
(20, 4, '지급 확인', 'M', 500, '2023-09-20 14:47:26', '0'),
(21, 4, '테스트', 'M', 1000, '2023-09-20 15:36:50', '0'),
(22, 4, '지급1000', 'D', 1000, '2023-09-20 15:37:22', '0'),
(23, 4, '차감500', 'D', -500, '2023-09-20 15:37:39', '0'),
(24, 4, '메디컬1', '원', 500000, '2023-09-21 14:36:22', '0'),
(25, 4, 'test', 'M', 1000, '2023-09-21 15:14:28', '0'),
(26, 5, 'dfsdf', 'M', 123, '2023-09-27 10:10:40', '0'),
(27, 5, '1312', 'D', 11, '2023-09-27 10:10:52', '0');

-- --------------------------------------------------------

--
-- 테이블 구조 `hospital_member_info`
--

CREATE TABLE `hospital_member_info` (
  `idx` int(11) NOT NULL COMMENT 'PK',
  `code` varchar(50) NOT NULL COMMENT '코드'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='병원 관계자 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `member_info`
--

CREATE TABLE `member_info` (
  `idx` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
  `member_type` varchar(10) DEFAULT 'GEN' COMMENT '회원종류, AD: 최고관리자, PM: 관리자, GEN: 회원',
  `member_code` varchar(30) DEFAULT NULL COMMENT '회원 코드',
  `user_id` varchar(80) NOT NULL COMMENT '회원 ID(이메일)',
  `user_pwd` text NOT NULL COMMENT '회원 비밀번호',
  `user_name` varchar(40) NOT NULL COMMENT '회원 이름',
  `user_last_name` varchar(10) NOT NULL COMMENT '영문명(성)',
  `user_first_name` varchar(20) NOT NULL COMMENT '영문명(이름)',
  `birthday` varchar(40) NOT NULL COMMENT '생년월일',
  `gender` tinyint(1) DEFAULT '0' COMMENT '성별 (0: 남자/1: 여자)',
  `phone_code` varchar(10) NOT NULL COMMENT '휴대폰 번호 (국가코드)',
  `phone_num` varchar(30) NOT NULL COMMENT '휴대폰 번호',
  `wechat_id` varchar(40) NOT NULL COMMENT '위챗 ID',
  `shilla_id` varchar(40) NOT NULL COMMENT '신라 면세점 ID',
  `passport_last_name` varchar(10) NOT NULL COMMENT '여권 영문명(성)',
  `passport_first_name` varchar(20) NOT NULL COMMENT '여권 영문명(이름)',
  `passport_num` varchar(30) NOT NULL COMMENT '여권번호',
  `passport_expire_date` datetime NOT NULL COMMENT '여권만료일',
  `data_type` tinyint(1) DEFAULT '0' COMMENT '개인정보 유효기간 (0: 회원 탈퇴시까지/1: 1년)',
  `profile_org` varchar(100) DEFAULT NULL COMMENT '프로필 사진 원본명',
  `profile_chg` varchar(100) DEFAULT 'default_profile.png' COMMENT '프리폴 사진 서버명',
  `voucher_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '바우처 발급여부 (0: N/1: Y)',
  `voucher_date` datetime DEFAULT NULL COMMENT '바우처 발급일자',
  `used_voucher` tinyint(1) NOT NULL DEFAULT '0' COMMENT '바우처 사용여부 (0: N/1: Y)',
  `wdate` datetime DEFAULT NULL COMMENT '등록일',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '탈퇴 여부 (Y: 1/N: 0)',
  `del_date` datetime DEFAULT NULL COMMENT '탈퇴일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='회원 테이블';

--
-- 테이블의 덤프 데이터 `member_info`
--

INSERT INTO `member_info` (`idx`, `member_type`, `member_code`, `user_id`, `user_pwd`, `user_name`, `user_last_name`, `user_first_name`, `birthday`, `gender`, `phone_code`, `phone_num`, `wechat_id`, `shilla_id`, `passport_last_name`, `passport_first_name`, `passport_num`, `passport_expire_date`, `data_type`, `profile_org`, `profile_chg`, `voucher_state`, `voucher_date`, `used_voucher`, `wdate`, `is_del`, `del_date`) VALUES
(1, 'AD', NULL, 'admin', '$2y$10$j639Z1hVftScRc2sjaukwO/iqN.90X6fzvgxiNySX4rGR9PUCkfGC', '최고관리자', '', '', '', 0, '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, NULL, 'default_profile.png', 0, NULL, 0, '2023-09-04 13:48:35', 0, NULL),
(3, 'GEN', 'A00003', 'symbol@test.com', '$2y$10$L5nlp3MBrweRhg5Nv0NI9OJ1puEC9zTTMnxx8KWWpJJUQqSSSMrNa', 'SONG KIHO', 'SONG', 'KIHO', '2003-07-19', 0, '82', '010-1234-5678', 'sds', 'dsdsd', 'Song', 'Kiho', '2332323', '2023-09-22 00:00:00', 0, 'orora.jpg', '1694076187-AVFOK.jpg', 1, '2023-09-26 14:31:08', 1, '2023-09-07 11:58:21', 0, NULL),
(4, 'GEN', 'A00004', 'happy@bn-system.com', '$2y$10$V/pn.meQXX9IXhv0SmBgCesgvKcYPZTMy5UB6AEZQESCSRvLa7hhu', 'TEST KR', 'TEST', 'KR', '2001-01-01', 1, '82', '100-000-0000', 'asd', 'asd', 'Test', 'test', 'asd', '2023-09-30 00:00:00', 1, 'benefit_4.png', '1695191748-PSSJN.png', 0, NULL, 0, '2023-09-08 09:06:17', 0, NULL),
(5, 'GEN', 'A00005', 'yko1290@daum.net', '$2y$10$i8Kh5cKGbCXtEVGJAZrKZuXbqw7pP0zuhJYXL3yIdcnG0kCHalkJ2', 'TEST CN', 'TEST', 'CN', '1984-09-12', 1, '86', '10-1234-1234', 'test1', 'test1', 'test', 'cn', 'passport1', '2023-09-30 00:00:00', 1, NULL, 'default_profile.png', 0, NULL, 0, '2023-09-20 16:09:25', 0, NULL),
(6, 'GEN', 'A00006', 'whwjddnjs8@naver.com', '$2y$10$S.hR7XI44a5ZNLvANES3FuHoU1//PG/u0ooBe0OxXZI9W.vF6T1k6', 'JO JEONGWON', 'JO', 'JEONGWON', '1998-07-19', 1, '82', '108-949-4207', 'whwjddnjs', 'whwjddnjs', 'jo', 'jeongwon', '123123123', '2065-02-12 00:00:00', 0, NULL, 'default_profile.png', 0, NULL, 0, '2023-09-22 16:23:09', 0, NULL),
(7, 'GEN', 'A00007', 'test@test.com', '$2y$10$L5nlp3MBrweRhg5Nv0NI9OJ1puEC9zTTMnxx8KWWpJJUQqSSSMrNa', 'Tester', 'Tester', '', '0000-00-00', 1, '82', '010-0000-0000', '', '', 'Tester', '', '0000', '0000-00-00 00:00:00', 0, NULL, 'default_profile.png', 0, NULL, 0, '2023-09-26 10:05:23', 0, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `promotion_info`
--

CREATE TABLE `promotion_info` (
  `idx` int(11) NOT NULL PRIMARY KEY COMMENT 'PK',
  `code` varchar(50) DEFAULT NULL COMMENT '프로모션 코드',
  `hospital` varchar(60) NOT NULL COMMENT '병원명',
  `hospital_type` varchar(30) DEFAULT NULL COMMENT '병원 구분',
  `location` varchar(120) NOT NULL COMMENT '병원 위치',
  `procedure` varchar(50) NOT NULL COMMENT '시술명',
  `is_promotion` tinyint(1) DEFAULT '0' COMMENT '프로모션 여부 (0: N/1: Y)',
  `amount` int(11) DEFAULT '0' COMMENT '재고 수량',
  `procedure_file_org` varchar(100) DEFAULT NULL COMMENT '시술 상세 기존 파일명',
  `procedure_file_chg` varchar(100) DEFAULT NULL COMMENT '시술 상세 서버 파일명',
  `hospital_info` text NOT NULL COMMENT '병원 정보',
  `major_procedures` text NOT NULL COMMENT '주요 시술',
  `hospital_pos` text NOT NULL COMMENT '병원 주소',
  `hospital_id` varchar(100) NOT NULL COMMENT '병원 ID',
  `hospital_code` varchar(100) NOT NULL COMMENT '병원 코드',
  `operating_time` text NOT NULL COMMENT '운영 시간',
  `banner_file_org` varchar(100) DEFAULT NULL COMMENT '배너 이미지 기존 파일명',
  `banner_file_chg` int(100) DEFAULT NULL COMMENT '배너 이미지 서버 파일명',
  `hospital_in_file_org` varchar(100) DEFAULT NULL COMMENT '병원 내부 기존 파일명',
  `hospital_in_file_chg` varchar(100) DEFAULT NULL COMMENT '병원 내부 서버 파일명',
  `hospital_view_file_org` varchar(100) DEFAULT NULL COMMENT '병원 전경 기존 파일명',
  `hospital_view_file_chg` varchar(100) DEFAULT NULL COMMENT '병원 전경 서버 파일명',
  `hospital_review_file_org` varchar(100) DEFAULT NULL COMMENT '병원 후기 기존 파일명',
  `hospital_review_file_chg` varchar(100) DEFAULT NULL COMMENT '병원 후기 서버 파일명',
  `logo_file_org` varchar(100) DEFAULT NULL COMMENT '로고 기존 파일명',
  `logo_file_chg` varchar(100) DEFAULT NULL COMMENT '로고 서버 파일명',
  `wdate` datetime DEFAULT NULL COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='프로모션 테이블';

--
-- 테이블의 덤프 데이터 `promotion_info`
--

INSERT INTO `promotion_info` (`idx`, `code`, `hospital`, `hospital_type`, `location`, `procedure`, `is_promotion`, `amount`, `procedure_file_org`, `procedure_file_chg`, `hospital_info`, `major_procedures`, `hospital_pos`, `hospital_id`, `hospital_code`, `operating_time`, `banner_file_org`, `banner_file_chg`, `hospital_in_file_org`, `hospital_in_file_chg`, `hospital_view_file_org`, `hospital_view_file_chg`, `hospital_review_file_org`, `hospital_review_file_chg`, `logo_file_org`, `logo_file_chg`, `wdate`) VALUES
(4, 'P00004', '휴한의원', '한의원', 'In earth', '테스트 시술', 1, 1, 'space.jpg', '1695705850-HCYJG.jpg', 'test', 'test', 'test', '646a219e953c858bbe7109e6', 'M5624', 'test', 'starlight.jpg', 1695705850, 'orora.jpg', '1695705850-BYLZF.jpg', 'space.jpg', '1695705850-SYROL.jpg', 'review_img.png', '1695705850-SCNGQ.png', 'test.png', '1695705850-RYYRS.png', '2023-09-26 14:24:10');

-- --------------------------------------------------------

--
-- 테이블 구조 `receipt_info`
--

CREATE TABLE `receipt_info` (
  `idx` int(11) NOT NULL COMMENT 'PK',
  `member_idx` int(11) NOT NULL COMMENT 'member_info PK',
  `receipt_type` varchar(30) NOT NULL COMMENT '영수증 구분 (면세점 구매/메디컬 구매)',
  `file_org` varchar(100) NOT NULL COMMENT '파일 원본명',
  `file_chg` varchar(100) NOT NULL COMMENT '파일 서버명'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='구매영수증 테이블';

--
-- 테이블의 덤프 데이터 `receipt_info`
--

INSERT INTO `receipt_info` (`idx`, `member_idx`, `receipt_type`, `file_org`, `file_chg`) VALUES
(1, 3, '면세점 구매', 'starlight.jpg', '1695270810-ASGZQ.jpg');

-- --------------------------------------------------------

--
-- 테이블 구조 `reservation_info`
--

CREATE TABLE `reservation_info` (
  `idx` int(11) NOT NULL COMMENT 'PK',
  `member_idx` int(11) NOT NULL COMMENT 'member_info PK',
  `reserve_id` varchar(100) NOT NULL COMMENT '예약 ID',
  `reserve_uuid` varchar(20) NOT NULL COMMENT '예약 번호',
  `hospital_id` varchar(100) NOT NULL COMMENT '병원 ID',
  `hospital_code` varchar(10) NOT NULL COMMENT '병원 코드',
  `surgery_addons` text NOT NULL COMMENT '추가시술명',
  `point` int(11) DEFAULT '0' COMMENT '사용한 포인트',
  `paid` int(11) DEFAULT '0' COMMENT '실 결제금액',
  `memo` text NOT NULL COMMENT '메모'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='예약정보 테이블';

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `buy_history_info`
--
ALTER TABLE `buy_history_info`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `currency_info`
--
ALTER TABLE `currency_info`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `hospital_member_info`
--
ALTER TABLE `hospital_member_info`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member_info`
--
ALTER TABLE `member_info`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `promotion_info`
--
ALTER TABLE `promotion_info`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `receipt_info`
--
ALTER TABLE `receipt_info`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `reservation_info`
--
ALTER TABLE `reservation_info`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `buy_history_info`
--
ALTER TABLE `buy_history_info`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=12;

--
-- 테이블의 AUTO_INCREMENT `currency_info`
--
ALTER TABLE `currency_info`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=28;

--
-- 테이블의 AUTO_INCREMENT `hospital_member_info`
--
ALTER TABLE `hospital_member_info`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK';

--
-- 테이블의 AUTO_INCREMENT `member_info`
--
ALTER TABLE `member_info`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `promotion_info`
--
ALTER TABLE `promotion_info`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `receipt_info`
--
ALTER TABLE `receipt_info`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `reservation_info`
--
ALTER TABLE `reservation_info`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
