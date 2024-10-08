-- 회원 테이블 시작
CREATE TABLE member_info(
    `idx` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
    `member_type` VARCHAR(10) DEFAULT 'GEN' COMMENT '회원종류, AD: 최고관리자, PM: 관리자, GEN: 회원',
    `member_code` VARCHAR(30) DEFAULT NULL COMMENT '회원 코드',
    `user_id` VARCHAR(80) NOT NULL COMMENT '회원 ID(이메일)',
    `user_pwd` TEXT NOT NULL COMMENT '회원 비밀번호',
    `user_name` VARCHAR(40) NOT NULL COMMENT '회원 이름',
    `user_last_name` VARCHAR(10) NOT NULL COMMENT '영문명(성)',
    `user_first_name` VARCHAR(20) NOT NULL COMMENT '영문명(이름)',
    `birthday` VARCHAR(40) NOT NULL COMMENT '생년월일',
    `gender` TINYINT(1) DEFAULT 0 COMMENT '성별 (0: 남자/1: 여자)',
    `phone_code` VARCHAR(10) NOT NULL COMMENT '휴대폰 번호 (국가코드)',
    `phone_num` VARCHAR(30) NOT NULL COMMENT '휴대폰 번호',
    `wechat_id` VARCHAR(40) NOT NULL COMMENT '위챗 ID',
    `shilla_id` VARCHAR(40) NOT NULL COMMENT '신라 면세점 ID',
    `passport_last_name` VARCHAR(10) NOT NULL COMMENT '여권 영문명(성)',
    `passport_first_name` VARCHAR(20) NOT NULL COMMENT '여권 영문명(이름)',
    `passport_num` VARCHAR(30) NOT NULL COMMENT '여권번호',
    `passport_expire_date` DATETIME NOT NULL COMMENT '여권만료일',
    `data_type` TINYINT(1) DEFAULT 0 COMMENT '개인정보 유효기간 (0: 회원 탈퇴시까지/1: 1년)',
    `voucher_state` TINYINT(1) DEFAULT 0 COMMENT '바우처 발급여부 (0: N/1: Y)',
    `voucher_date` DATETIME DEFAULT NULL COMMENT '바우처 발급일자',
    `used_voucher` TINYINT(1) DEFAULT 0 COMMENT '바우처 사용여부 (0: N/1: Y)',
    `wdate` DATETIME DEFAULT NULL COMMENT '등록일',
    `is_del` TINYINT(1) DEFAULT 0 COMMENT '탈퇴 여부 (Y: 1/N: 0)',
    `del_date` DATETIME DEFAULT NULL COMMENT '탈퇴일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='회원 테이블';
-- 회원 테이블 종료

-- 회원 테이블 최고관리자 등록 시작
INSERT INTO member_info (`member_type`, `user_id`, `user_pwd`, `user_name`, `wdate`) VALUES ('AD', 'admin', '$2y$10$j639Z1hVftScRc2sjaukwO/iqN.90X6fzvgxiNySX4rGR9PUCkfGC', '최고관리자', NOW());
-- 회원 테이블 최고관리자 등록 종료

-- 재화 테이블 시작
CREATE TABLE currency_info(
    `idx` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
    `member_idx` INT NOT NULL COMMENT 'member_info PK',
    `source` VARCHAR(60) NOT NULL COMMENT '출처',
    `currency` VARCHAR(30) NOT NULL COMMENT '통화',
    `amount` INT NOT NULL COMMENT '수량',
    `wdate` DATETIME NOT NULL COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='재화 테이블';
-- 재화 테이블 종료

-- 구매내역 테이블 시작
CREATE TABLE buy_history_info(
    `idx` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
    `currency_idx` INT NOT NULL COMMENT 'currency_info PK',
    `type` TINYINT(1) NOT NULL COMMENT '구매내역 구분 (0: 면세점/1: 메디컬)',
    `subject` VARCHAR(100) NOT NULL COMMENT '제목',
    `gubun` VARCHAR(100) NOT NULL COMMENT '시술명 또는 온라인/오프라인',
    `date` DATETIME DEFAULT NULL COMMENT '날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='구매내역 테이블';
-- 구매내역 테이블 종료

-- 구매영수증 테이블 시작
CREATE TABLE receipt_info(
    `idx` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
    `member_idx` INT NOT NULL COMMENT 'member_info PK',
    `receipt_type` VARCHAR(30) NOT NULL COMMENT '영수증 구분 (면세점 구매/메디컬 구매)',
    `file_org` VARCHAR(100) NOT NULL COMMENT '파일 원본명',
    `file_chg` VARCHAR(100) NOT NULL COMMENT '파일 서버명'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='구매영수증 테이블';
-- 구매영수증 테이블 종료

-- 예약정보 테이블 시작
CREATE TABLE reservation_info(
    `idx` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
    `member_idx` INT NOT NULL COMMENT 'member_info PK',
    `promotion_idx` INT NOT NULL COMMENT 'promotion_info PK',
    `reserve_id` VARCHAR(100) NOT NULL COMMENT '예약 ID',
    `reserve_uuid` VARCHAR(20) NOT NULL COMMENT '예약 번호',
    `hospital_id` VARCHAR(100) NOT NULL COMMENT '병원 ID',
    `hospital_code` VARCHAR(10) NOT NULL COMMENT '병원 코드',
    `surgery_addons` TEXT NOT NULL COMMENT '추가시술명',
    `point` INT DEFAULT 0 COMMENT '사용한 포인트',
    `paid` INT DEFAULT 0 COMMENT '실 결제금액',
    `memo` TEXT NOT NULL COMMENT '메모'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='예약정보 테이블';
-- 예약정보 테이블 종료

-- 프로모션 테이블 시작
CREATE TABLE promotion_info(
    `idx` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
    `code` VARCHAR(50) DEFAULT NULL COMMENT '코드',
    `hospital` VARCHAR(60) NOT NULL COMMENT '병원명',
    `hospital_type` VARCHAR(30) NOT NULL COMMENT '병원 타입',
    `location` VARCHAR(120) NOT NULL COMMENT '병원 위치',
    `procedure` VARCHAR(50) NOT NULL COMMENT '시술명',
    `is_promotion` TINYINT(1) DEFAULT 0 COMMENT '프로모션 여부 (0: N/1: Y)',
    `amount` INT DEFAULT 0 COMMENT '재고 수량',
    `procedure_file_org` VARCHAR(100) DEFAULT NULL COMMENT '시술 상세 기존 파일명',
    `procedure_file_chg` VARCHAR(100) DEFAULT NULL COMMENT '시술 상세 서버 파일명',
    `hospital_info` TEXT NOT NULL COMMENT '병원 정보',
    `major_procedures` TEXT NOT NULL COMMENT '주요 시술',
    `operating_time` TEXT NOT NULL COMMENT '운영 시간',
    `hospital_pos` TEXT NOT NULL COMMENT '병원 주소',
    `hospital_id` VARCHAR(100) NOT NULL COMMENT '병원 ID',
    `hospital_code` VARCHAR(100) NOT NULL COMMENT '병원 코드',
    `banner_file_org` VARCHAR(100) DEFAULT NULL COMMENT '배너 이미지 기존 파일명',
    `banner_file_chg` VARCHAR(100) DEFAULT NULL COMMENT '배너 이미지 서버 파일명',
    `hospital_in_file_org` VARCHAR(100) DEFAULT NULL COMMENT '병원 내부 기존 파일명',
    `hospital_in_file_chg` VARCHAR(100) DEFAULT NULL COMMENT '병원 내부 서버 파일명',
    `hospital_view_file_org` VARCHAR(100) DEFAULT NULL COMMENT '병원 전경 기존 파일명',
    `hospital_view_file_chg` VARCHAR(100) DEFAULT NULL COMMENT '병원 전경 서버 파일명',
    `hospital_review_file_org` VARCHAR(100) DEFAULT NULL COMMENT '병원 후기 기존 파일명',
    `hospital_review_file_chg` VARCHAR(100) DEFAULT NULL COMMENT '병원 후기 서버 파일명',
    `logo_file_org` VARCHAR(100) DEFAULT NULL COMMENT '로고 기존 파일명',
    `logo_file_chg` VARCHAR(100) DEFAULT NULL COMMENT '로고 서버 파일명',
    `wdate` DATETIME DEFAULT NULL COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='프로모션 테이블';
-- 프로모션 테이블 종료

-- 프로모션 이미지 테이블 시작
CREATE TABLE promotion_image_list(
    `idx` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
    `promotion_idx` INT NOT NULL COMMENT 'promotion_info PK',
    `type` VARCHAR(50) NOT NULL COMMENT '구분',
    `file_org` VARCHAR(100) DEFAULT NULL COMMENT '기존 파일명',
    `file_chg` VARCHAR(100) DEFAULT NULL COMMENT '서버 파일명'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='프로모션 이미지 테이블';
-- 프로모션 이미지 테이블 종료

-- 비밀번호 찾기 링크 세션 테이블 시작
CREATE TABLE link_session_list(
    `idx` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
    `code` VARCHAR(20) NOT NULL COMMENT '세션 코드',
    `extra` TEXT NOT NULL COMMENT '데이터 json',
    `expire` INT NOT NULL COMMENT '만료'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='링크 세션 테이블';
-- 비밀번호 찾기 링크 세션 테이블 종료