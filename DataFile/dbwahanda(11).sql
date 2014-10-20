-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2014 at 04:29 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbwahanda`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_title` varchar(45) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time_start` time NOT NULL,
  `appointment_time_end` time NOT NULL,
  `appointment_source` varchar(45) NOT NULL,
  `appointment_client_name` varchar(45) NOT NULL,
  `appointment_client_email` varchar(45) NOT NULL,
  `appointment_user_service_id` int(11) NOT NULL,
  `appointment_client_phone` varchar(45) NOT NULL,
  `appointment_client_gender` varchar(45) NOT NULL,
  `appointment_client_birth` date NOT NULL,
  `appointment_user_id` int(11) NOT NULL,
  `appointment_created` date NOT NULL,
  `appointment_updated` date NOT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `appointment_title`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `appointment_source`, `appointment_client_name`, `appointment_client_email`, `appointment_user_service_id`, `appointment_client_phone`, `appointment_client_gender`, `appointment_client_birth`, `appointment_user_id`, `appointment_created`, `appointment_updated`) VALUES
(1, 'Non title', '2014-10-10', '08:00:00', '08:30:00', '', 'Khach hang A', '', 1, '', '', '0000-00-00', 1, '0000-00-00', '0000-00-00'),
(2, 'Khach dat', '2014-10-10', '09:00:00', '10:00:00', '', 'Khach hang B', '', 1, '', '', '0000-00-00', 1, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_status` int(11) NOT NULL,
  `booking_total` int(20) NOT NULL,
  `booking_client_id` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_date`, `booking_status`, `booking_total`, `booking_client_id`) VALUES
('BK00000001', '2014-10-12', 1, 800000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE IF NOT EXISTS `booking_detail` (
  `booking_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_detail_price` int(11) NOT NULL,
  `booking_detail_date` date NOT NULL,
  `booking_detail_time_start` time NOT NULL,
  `booking_detail_time_end` time NOT NULL,
  `booking_detail_user_id` int(11) NOT NULL,
  `booking_detail_user_service_id` int(11) NOT NULL,
  `booking_detail_booking_id` varchar(255) NOT NULL,
  PRIMARY KEY (`booking_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`booking_detail_id`, `booking_detail_price`, `booking_detail_date`, `booking_detail_time_start`, `booking_detail_time_end`, `booking_detail_user_id`, `booking_detail_user_service_id`, `booking_detail_booking_id`) VALUES
(1, 400000, '2014-10-15', '08:30:00', '09:00:00', 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(50) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_pass` varchar(50) NOT NULL,
  `client_phone` varchar(50) NOT NULL,
  `client_postcode` varchar(50) NOT NULL,
  `client_username` varchar(50) NOT NULL,
  `client_sex` int(11) NOT NULL,
  `client_creditpoint` int(11) NOT NULL,
  `client_giftpoint` int(11) NOT NULL,
  `client_birth` date NOT NULL DEFAULT '1992-01-01',
  `client_is_sendmail` int(11) NOT NULL DEFAULT '0',
  `client_join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client_verify` varchar(255) NOT NULL,
  `client_is_active` int(11) NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_email` (`client_email`),
  UNIQUE KEY `client_username` (`client_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_email`, `client_pass`, `client_phone`, `client_postcode`, `client_username`, `client_sex`, `client_creditpoint`, `client_giftpoint`, `client_birth`, `client_is_sendmail`, `client_join_date`, `client_verify`, `client_is_active`) VALUES
(1, 'LeTrongLoi', 'trongloikt192@gmail.com', 'bd18fa92a97df32d0da484fe76ad2dc2', '123456789', '70000', 'trongloikt192', 0, 0, 0, '1992-01-01', 0, '2014-08-31 17:15:55', '88399349280acb8805887b3a269a02ea', 1),
(2, 'Nguyễn Trung Việt', 'vietnt134@gmail.com', 'a3ed0c6e51714fedb944c820b63b3c7a', '0903676222', '70000', 'viet_nt', 0, 0, 0, '1992-01-01', 0, '2014-09-12 02:21:03', '2d4e4f0b2a29ce2484d87c69ec77c09b', 1),
(3, 'Việt Nguyễn', '10520649@gm.uit.edu.vn', 'a3ed0c6e51714fedb944c820b63b3c7a', '0903676222', '70000', 'vietnt134', 0, 0, 0, '1992-01-01', 0, '2014-09-27 17:49:44', 'd9c20a3111c6dfb0df091a5b04593a06', 1),
(4, 'Le Trong Loi', 'test@gmail.com', 'b1cd4530a5f2cd67abf08d6f6f2341d9', '090909090', '0909', 'test', 0, 0, 0, '1992-01-01', 0, '2014-10-12 13:06:59', 'cdd2b211cfe882df06fdcea4875361f7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_content` text NOT NULL,
  `comment_status` int(11) NOT NULL DEFAULT '0',
  `comment_client_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_content`, `comment_status`, `comment_client_id`, `comment_user_id`) VALUES
(1, 'Dịch vụ rất hay tối sẽ giới thiệu cho bạn bè biết về dịch vụ này, cám ơn chủ spa...', 0, 2, 1),
(2, 'Tệ hại.....', 0, 2, 1),
(3, 'Tệ hại....tôi sẽ kiện, tôi sẽ không dùng dịch vụ này nữa', 0, 2, 1),
(4, 'Dịch vụ này hay nè, bà con zô ủng hộ anh chủ spa đẹp trai đi', 0, 2, 1),
(5, 'Chào bạn, mình xin trình bày thế này, mình đi trễ tầm 10 phút nhưng khi đến đã bị nhân viên phàn này này nọ, họ tỏ ra rất khó chịu với mình...', 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=253 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua and Barbuda'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Azerbaijan'),
(18, 'Bahamas'),
(19, 'Bahrain'),
(20, 'Bangladesh'),
(21, 'Barbados'),
(22, 'Belarus'),
(23, 'Belgium'),
(24, 'Belize'),
(25, 'Benin'),
(26, 'Bermuda'),
(27, 'Bhutan'),
(28, 'Bolivia'),
(29, 'Bosnia and Herzegovina'),
(30, 'Botswana'),
(31, 'Bouvet Island'),
(32, 'Brazil'),
(33, 'British Indian Ocean Territory'),
(34, 'Brunei Darussalam'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cambodia'),
(39, 'Cameroon'),
(40, 'Canada'),
(41, 'Cape Verde'),
(42, 'Cayman Islands'),
(43, 'Central African Republic'),
(44, 'Chad'),
(45, 'Chile'),
(46, 'China'),
(47, 'Christmas Island'),
(48, 'Cocos (Keeling) Islands'),
(49, 'Colombia'),
(50, 'Comoros'),
(51, 'Congo'),
(52, 'Congo, The Democratic Republic of The'),
(53, 'Cook Islands'),
(54, 'Costa Rica'),
(55, 'Cote D''ivoire'),
(56, 'Croatia'),
(57, 'Cuba'),
(58, 'Cyprus'),
(60, 'Czech Republic'),
(61, 'Denmark'),
(62, 'Djibouti'),
(63, 'Dominica'),
(64, 'Dominican Republic'),
(65, 'Easter Island'),
(66, 'Ecuador'),
(67, 'Egypt'),
(68, 'El Salvador'),
(69, 'Equatorial Guinea'),
(70, 'Eritrea'),
(71, 'Estonia'),
(72, 'Ethiopia'),
(73, 'Falkland Islands (Malvinas)'),
(74, 'Faroe Islands'),
(75, 'Fiji'),
(76, 'Finland'),
(77, 'France'),
(78, 'French Guiana'),
(79, 'French Polynesia'),
(80, 'French Southern Territories'),
(81, 'Gabon'),
(82, 'Gambia'),
(83, 'Georgia'),
(85, 'Germany'),
(86, 'Ghana'),
(87, 'Gibraltar'),
(88, 'Greece'),
(89, 'Greenland'),
(91, 'Grenada'),
(92, 'Guadeloupe'),
(93, 'Guam'),
(94, 'Guatemala'),
(95, 'Guinea'),
(96, 'Guinea-bissau'),
(97, 'Guyana'),
(98, 'Haiti'),
(99, 'Heard Island and Mcdonald Islands'),
(100, 'Honduras'),
(101, 'Hong Kong'),
(102, 'Hungary'),
(103, 'Iceland'),
(104, 'India'),
(105, 'Indonesia'),
(106, 'Indonesia'),
(107, 'Iran'),
(108, 'Iraq'),
(109, 'Ireland'),
(110, 'Israel'),
(111, 'Italy'),
(112, 'Jamaica'),
(113, 'Japan'),
(114, 'Jordan'),
(115, 'Kazakhstan'),
(116, 'Kazakhstan'),
(117, 'Kenya'),
(118, 'Kiribati'),
(119, 'Korea, North'),
(120, 'Korea, South'),
(121, 'Kosovo'),
(122, 'Kuwait'),
(123, 'Kyrgyzstan'),
(124, 'Laos'),
(125, 'Latvia'),
(126, 'Lebanon'),
(127, 'Lesotho'),
(128, 'Liberia'),
(129, 'Libyan Arab Jamahiriya'),
(130, 'Liechtenstein'),
(131, 'Lithuania'),
(132, 'Luxembourg'),
(133, 'Macau'),
(134, 'Macedonia'),
(135, 'Madagascar'),
(136, 'Malawi'),
(137, 'Malaysia'),
(138, 'Maldives'),
(139, 'Mali'),
(140, 'Malta'),
(141, 'Marshall Islands'),
(142, 'Martinique'),
(143, 'Mauritania'),
(144, 'Mauritius'),
(145, 'Mayotte'),
(146, 'Mexico'),
(147, 'Micronesia, Federated States of'),
(148, 'Moldova, Republic of'),
(149, 'Monaco'),
(150, 'Mongolia'),
(151, 'Montenegro'),
(152, 'Montserrat'),
(153, 'Morocco'),
(154, 'Mozambique'),
(155, 'Myanmar'),
(156, 'Namibia'),
(157, 'Nauru'),
(158, 'Nepal'),
(159, 'Netherlands'),
(160, 'Netherlands Antilles'),
(161, 'New Caledonia'),
(162, 'New Zealand'),
(163, 'Nicaragua'),
(164, 'Niger'),
(165, 'Nigeria'),
(166, 'Niue'),
(167, 'Norfolk Island'),
(168, 'Northern Mariana Islands'),
(169, 'Norway'),
(170, 'Oman'),
(171, 'Pakistan'),
(172, 'Palau'),
(173, 'Palestinian Territory'),
(174, 'Panama'),
(175, 'Papua New Guinea'),
(176, 'Paraguay'),
(177, 'Peru'),
(178, 'Philippines'),
(179, 'Pitcairn'),
(180, 'Poland'),
(181, 'Portugal'),
(182, 'Puerto Rico'),
(183, 'Qatar'),
(184, 'Reunion'),
(185, 'Romania'),
(186, 'Russia'),
(187, 'Russia'),
(188, 'Rwanda'),
(189, 'Saint Helena'),
(190, 'Saint Kitts and Nevis'),
(191, 'Saint Lucia'),
(192, 'Saint Pierre and Miquelon'),
(193, 'Saint Vincent and The Grenadines'),
(194, 'Samoa'),
(195, 'San Marino'),
(196, 'Sao Tome and Principe'),
(197, 'Saudi Arabia'),
(198, 'Senegal'),
(199, 'Serbia and Montenegro'),
(200, 'Seychelles'),
(201, 'Sierra Leone'),
(202, 'Singapore'),
(203, 'Slovakia'),
(204, 'Slovenia'),
(205, 'Solomon Islands'),
(206, 'Somalia'),
(207, 'South Africa'),
(208, 'South Georgia and The South Sandwich Islands'),
(209, 'Spain'),
(210, 'Sri Lanka'),
(211, 'Sudan'),
(212, 'Suriname'),
(213, 'Svalbard and Jan Mayen'),
(214, 'Swaziland'),
(215, 'Sweden'),
(216, 'Switzerland'),
(217, 'Syria'),
(218, 'Taiwan'),
(219, 'Tajikistan'),
(220, 'Tanzania, United Republic of'),
(221, 'Thailand'),
(222, 'Timor-leste'),
(223, 'Togo'),
(224, 'Tokelau'),
(225, 'Tonga'),
(226, 'Trinidad and Tobago'),
(227, 'Tunisia'),
(228, 'Turkey'),
(229, 'Turkey'),
(230, 'Turkmenistan'),
(231, 'Turks and Caicos Islands'),
(232, 'Tuvalu'),
(233, 'Uganda'),
(234, 'Ukraine'),
(235, 'United Arab Emirates'),
(236, 'United Kingdom'),
(237, 'United States'),
(238, 'United States Minor Outlying Islands'),
(239, 'Uruguay'),
(240, 'Uzbekistan'),
(241, 'Vanuatu'),
(242, 'Vatican City'),
(243, 'Venezuela'),
(244, 'Vietnam'),
(245, 'Virgin Islands, British'),
(246, 'Virgin Islands, U.S.'),
(247, 'Wallis and Futuna'),
(248, 'Western Sahara'),
(249, 'Yemen'),
(250, 'Yemen'),
(251, 'Zambia'),
(252, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`) VALUES
(760, 'Quận 1'),
(761, 'Quận 12'),
(763, 'Quận 9'),
(769, 'Quận 2'),
(770, 'Quận 3'),
(771, 'Quận 10'),
(772, 'Quận 11'),
(773, 'Quận 4'),
(774, 'Quận 5'),
(775, 'Quận 6'),
(776, 'Quận 8'),
(778, 'Quận 7');

-- --------------------------------------------------------

--
-- Table structure for table `e_voucher`
--

CREATE TABLE IF NOT EXISTS `e_voucher` (
  `e_voucher_id` varchar(255) NOT NULL,
  `e_voucher_due_date` date NOT NULL,
  `e_voucher_price` int(20) NOT NULL,
  `e_voucher_user_service_id` int(11) NOT NULL,
  `e_voucher_booking_id` varchar(255) NOT NULL,
  `e_voucher_user_id` int(11) NOT NULL,
  PRIMARY KEY (`e_voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gift_voucher`
--

CREATE TABLE IF NOT EXISTS `gift_voucher` (
  `gift_voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `gift_voucher_code` varchar(50) NOT NULL,
  `gift_voucher_due_date` date NOT NULL,
  `gift_voucher_price` varchar(50) NOT NULL,
  PRIMARY KEY (`gift_voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_service`
--

CREATE TABLE IF NOT EXISTS `group_service` (
  `group_service_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_service_name` varchar(50) NOT NULL,
  `group_service_user_id` int(11) NOT NULL,
  `group_service_delete_flg` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `group_service`
--

INSERT INTO `group_service` (`group_service_id`, `group_service_name`, `group_service_user_id`, `group_service_delete_flg`) VALUES
(1, 'Cắt tóc', 1, 0),
(2, 'Massage toàn thân', 1, 0),
(3, 'Chăm sóc móng chuyên nghiệp', 2, 0),
(4, 'Làm mặt Brazil', 3, 0),
(5, 'Thể dục thẩm mỹ', 4, 0),
(6, 'Dịch vụ tổng hợp', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `promotion_id` int(11) NOT NULL AUTO_INCREMENT,
  `promotion_content` text NOT NULL,
  PRIMARY KEY (`promotion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_name` varchar(255) NOT NULL,
  `review_field` varchar(255) NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `review_name`, `review_field`) VALUES
(1, 'TỔNG THỂ', 'user_review_overall'),
(2, 'Sự nhiệt tình', 'user_review_active'),
(3, 'Vệ sinh', 'user_review_clean'),
(4, 'Chất lượng', 'user_review_quality'),
(5, 'Nhân viên', 'user_review_staff'),
(6, 'Giá trị', 'user_review_valuable');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(50) NOT NULL,
  `service_image` text NOT NULL,
  `service_service_type_id` int(11) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `service_image`, `service_service_type_id`) VALUES
(1, 'Cắt tóc chuyên nghiệp', '', 1),
(2, 'Làm đầu', '', 1),
(3, 'Gội đầu', '', 1),
(4, 'Massage da mặt', '', 5),
(5, 'Massage toàn thân', '', 5),
(6, 'Chăm sóc móng', '', 3),
(7, 'Trang điểm', '', 4),
(8, 'Thể dục thẩm mỹ', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE IF NOT EXISTS `service_type` (
  `service_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`service_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`service_type_id`, `service_type_name`) VALUES
(1, 'TÓC'),
(2, 'BODY'),
(3, 'MÓNG'),
(4, 'MẶT'),
(5, 'MASSAGE'),
(6, 'THỂ DỤC THẨM MỸ');

-- --------------------------------------------------------

--
-- Table structure for table `type_business`
--

CREATE TABLE IF NOT EXISTS `type_business` (
  `type_business_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_business_name` varchar(50) NOT NULL,
  PRIMARY KEY (`type_business_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `type_business`
--

INSERT INTO `type_business` (`type_business_id`, `type_business_name`) VALUES
(1, 'Airsport Spa'),
(2, 'Beauty Salon'),
(3, 'Cắt tóc chuyên nghiệp'),
(4, 'Spa');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_full_name` varchar(50) NOT NULL,
  `user_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_business_name` varchar(50) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_facebook` varchar(50) DEFAULT NULL,
  `user_googleplus` varchar(50) DEFAULT NULL,
  `user_website` varchar(50) DEFAULT NULL,
  `user_description` text,
  `user_open_hour` varchar(255) DEFAULT '{"Monday":[8,20],"Monday":[8,20],"Monday":[8,20],"Tueday":[8,20],"Wednesday":[8,20],"Thursday":[8,20],"Friday":[8,20],"Saturday":[],"Sunday":[]}',
  `user_post_code` varchar(10) NOT NULL,
  `user_lat` varchar(255) NOT NULL,
  `user_long` varchar(255) NOT NULL,
  `user_logo` text NOT NULL,
  `user_slide` text NOT NULL,
  `user_is_use_voucher` int(11) NOT NULL DEFAULT '0',
  `user_tax_code` varchar(50) NOT NULL,
  `user_pre_name` varchar(50) NOT NULL,
  `user_district_id` int(5) NOT NULL,
  `user_lvl_id` int(11) NOT NULL,
  `user_type_business_id` int(11) NOT NULL,
  `user_bank_acc_owner` varchar(50) NOT NULL,
  `user_bank_acc` int(11) NOT NULL,
  `user_bank_name` varchar(50) NOT NULL,
  `user_bank_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `user_bank_branch` varchar(50) NOT NULL,
  `user_company_name` varchar(50) DEFAULT NULL,
  `user_company_address` varchar(255) DEFAULT NULL,
  `user_company_delegate` varchar(50) DEFAULT NULL,
  `user_company_tax_code` varchar(50) DEFAULT NULL,
  `user_company_district_id` int(5) DEFAULT NULL,
  `user_contact_name` varchar(50) DEFAULT NULL,
  `user_contact_email` varchar(50) DEFAULT NULL,
  `user_contact_phone` varchar(50) DEFAULT NULL,
  `user_contact_role` varchar(50) DEFAULT NULL,
  `user_notification_email` varchar(50) DEFAULT NULL,
  `user_limit_before_service` int(11) NOT NULL DEFAULT '180',
  `user_limit_before_booking` int(11) NOT NULL DEFAULT '30',
  `user_delete_flg` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `user_lvl_id` (`user_lvl_id`),
  KEY `user_type_business_id` (`user_type_business_id`),
  KEY `user_location_id` (`user_district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_full_name`, `user_email`, `user_password`, `user_business_name`, `user_phone`, `user_address`, `user_facebook`, `user_googleplus`, `user_website`, `user_description`, `user_open_hour`, `user_post_code`, `user_lat`, `user_long`, `user_logo`, `user_slide`, `user_is_use_voucher`, `user_tax_code`, `user_pre_name`, `user_district_id`, `user_lvl_id`, `user_type_business_id`, `user_bank_acc_owner`, `user_bank_acc`, `user_bank_name`, `user_bank_address`, `user_bank_branch`, `user_company_name`, `user_company_address`, `user_company_delegate`, `user_company_tax_code`, `user_company_district_id`, `user_contact_name`, `user_contact_email`, `user_contact_phone`, `user_contact_role`, `user_notification_email`, `user_limit_before_service`, `user_limit_before_booking`, `user_delete_flg`) VALUES
(1, '', 'admincp@gmail.com', '0e246b470994ecdc91f7bfb3506f3e7d', 'Spa Ngọc Trinh', '0123456789', '188A3 Man Thiện, Q.9, Tp.HCM', 'facebook.com/trongloikt192', 'plus.google.com/trongloikt192', 'trongloikt192.vn', 'Ngọc Trinh SPA được thành lập năm 2007 với các dịch vụ dành cho phái nữ, qua nhiều năm kinh nghiệm chúng tôi đã nhận được sự tín nhiệm từ khách hàng và ngày một nâng cao trình độ phục vụ. Ngọc Trinh SPA có các chi nhánh tại Hà Nội và thành phố Hồ Chí Minh. Ngọc Trinh SPA hân hạnh phục vụ quý khách.', '{"2":[1,8,22],"3":[1,9,22],"4":[1,9,22],"5":[1,8,22],"6":[1,16,22],"7":[0,8,22],"8":[0,8,22]}', '7000', '', '', 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/sao365-9.jpg', 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/73225-1920x1200.jpg', 1, 'TX2001', 'GD. Lê Trọng Lợi', 769, 0, 1, 'Nguyễn Minh Nhật', 767236, 'Techcombank', '69 Thống Nhất, Q.Thủ Đức, Tp. HCM', 'Techcombank Q.Bình Thạnh', 'Brights VIệt Nam', 'Meritime Bank Tower, P.Bến Nghé, Q.1, Tp.HCM', 'GD. Lê Trọng Lợi', 'TX2001', 769, 'Nguyễn Trung Việt', 'viet_nt@gmail.com', '0123829222', 'Trưởng phòng', NULL, 120, 84, 0),
(2, '', 'admin@gmail.com', '0e246b470994ecdc91f7bfb3506f3e7d', 'Salon Hoàn Vũ', '0903676222', '47/8/5, Đường 2, Phường Bình An, Quận 2, TPHCM', 'www.facebook.com/vietnt134', 'plus.google.com/trongloikt192', 'xvideos.com', 'Salon Hoàn Vũ được thành lập năm 2012 với các dịch vụ dành cho các bạn nam, qua nhiều năm kinh nghiệm chúng tôi đã nhận được sự tín nhiệm từ khách hàng và ngày một nâng cao trình độ phục vụ. Salon có các chi nhánh tại Hà Nội và thành phố Hồ Chí Minh. Salon Hoàn Vũ hân hạnh phục vụ quý khách.', '{"2":[1,8,19],"3":[1,9,19],"4":[1,9,19],"5":[1,8,19],"6":[1,16,19],"7":[1,8,12],"8":[0,8,22]}', '7000', '', '', 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/262144-1920x1080.jpg', 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/573066-1680x1050.jpg', 0, 'TX007', 'CT. Daniel Nguyen Viet', 769, 0, 2, 'Cu ly trưởng', 1002001456, 'TrungVietBank', '69 Thống Nhất, Q.Thủ Đức, Tp. HCM', 'TrungVietBank Australia', 'Salon Hoàn Vũ', NULL, 'CT. Daniel Nguyen Viet', 'TX007', 769, NULL, NULL, NULL, NULL, NULL, 60, 30, 0),
(3, '', 'robotspa@gmail.com', '0e246b470994ecdc91f7bfb3506f3e7d', 'Spa Robot', '0903676222', '47/8/5, Đường 2, Phường Bình An, Quận 2, TPHCM', 'www.facebook.com/vietnt134', 'plus.google.com/trongloikt192', 'vietnt134.site40.net', 'Spa Robot được thành lập năm 2012 với các dịch vụ dành cho các bạn nam, qua nhiều năm kinh nghiệm chúng tôi đã nhận được sự tín nhiệm từ khách hàng và ngày một nâng cao trình độ phục vụ. Salon có các chi nhánh tại Hà Nội và thành phố Hồ Chí Minh. Salon Hoàn Vũ hân hạnh phục vụ quý khách.', '{"2":[1,8,19],"3":[1,9,19],"4":[1,9,19],"5":[1,8,19],"6":[1,16,19],"7":[1,8,12],"8":[0,8,22]}', '7000', '', '', 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/3/spa-robot.jpg', 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/573066-1680x1050.jpg', 0, 'TX007', 'CT. Daniel Nguyen Viet', 763, 0, 4, 'Cu ly trưởng', 1002001456, 'TrungVietBank', '69 Thống Nhất, Q.Thủ Đức, Tp. HCM', 'TrungVietBank Australia', 'Spa Robot', NULL, 'CT. Daniel Nguyen Viet', 'TX007', 763, NULL, NULL, NULL, NULL, NULL, 90, 60, 0),
(4, '', 'hallobeautycare@gmail.com', '0e246b470994ecdc91f7bfb3506f3e7d', 'Hallo Beauty Care', '0903676222', '47/8/5, Đường 2, Phường Bình An, Quận 2, TPHCM', 'www.facebook.com/vietnt134', 'plus.google.com/trongloikt192', 'vietnt134.site40.net', 'Hallo được thành lập năm 2012 với các dịch vụ dành cho các bạn nam, qua nhiều năm kinh nghiệm chúng tôi đã nhận được sự tín nhiệm từ khách hàng và ngày một nâng cao trình độ phục vụ. Salon có các chi nhánh tại Hà Nội và thành phố Hồ Chí Minh. Hallo hân hạnh phục vụ quý khách.', '{"2":[1,8,19],"3":[1,9,19],"4":[1,9,19],"5":[1,8,19],"6":[1,16,19],"7":[1,8,12],"8":[0,8,22]}', '7000', '', '', 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/4/5739d_ORIG-2011_mens_health.jpg', 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/573066-1680x1050.jpg', 0, 'TX007', 'CT. Daniel Nguyen Viet', 763, 0, 3, 'Cu ly trưởng', 1002001456, 'TrungVietBank', '69 Thống Nhất, Q.Thủ Đức, Tp. HCM', 'TrungVietBank Australia', 'Spa Robot', NULL, 'CT. Daniel Nguyen Viet', 'TX007', 763, NULL, NULL, NULL, NULL, NULL, 60, 90, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_lvl`
--

CREATE TABLE IF NOT EXISTS `user_lvl` (
  `user_lvl_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_lvl_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_lvl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE IF NOT EXISTS `user_review` (
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_review_content` text,
  `user_review_active` int(11) NOT NULL DEFAULT '0',
  `user_review_clean` int(11) NOT NULL DEFAULT '0',
  `user_review_quality` int(11) NOT NULL DEFAULT '0',
  `user_review_staff` int(11) NOT NULL DEFAULT '0',
  `user_review_valuable` int(11) NOT NULL DEFAULT '0',
  `user_review_overall` int(11) NOT NULL DEFAULT '0',
  `user_review_time` time NOT NULL,
  `user_review_date` date NOT NULL,
  `user_review_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_review`
--

INSERT INTO `user_review` (`user_id`, `client_id`, `user_review_content`, `user_review_active`, `user_review_clean`, `user_review_quality`, `user_review_staff`, `user_review_valuable`, `user_review_overall`, `user_review_time`, `user_review_date`, `user_review_status`) VALUES
(1, 2, 'Dịch vụ rất bình thường.', 3, 2, 5, 5, 2, 4, '20:42:25', '2014-09-28', 1),
(1, 3, 'Rất hay tôi cho 4 sao nhá.', 5, 4, 4, 3, 4, 4, '22:37:24', '2014-10-02', 1),
(2, 1, 'Thanks chủ spa nhiều nhé, dịch vụ khá là tốt và sạch sẽ, nhân viên tận tình rất dễ thương, mình nghĩ 4 sao là quá đủ cho spa các bạn nhé.', 3, 1, 4, 3, 2, 3, '11:38:45', '2014-09-27', 1),
(2, 2, 'Dịch vụ ở đây cực kỳ hay luôn, rất nhanh và sạch sẽ, mình cho 4 sao luôn nhá. Các bạn hãy dùng dịch vụ này nhé đảm bảo hay luôn ấy. Còn nữa mình sẽ nói cho các bạn một bí mật nhá, mình rất là là đẹp trai đó nhá mình thích à nhá. Hehehe, còn nữa mình đang test comment nên các bạn đừng có ném đá mình nha tội nghiệp mình lắm đó mấy bạn ợ.', 4, 5, 5, 3, 4, 3, '21:16:00', '2014-09-29', 1),
(2, 3, 'Quá tệ cho 1 dịch vụ...', 0, 4, 0, 5, 3, 4, '01:05:47', '2014-09-28', 1),
(3, 2, 'Nhân viên cực kỳ dễ thường luôn, đặc biệt là anh Thanh hugo anh ấy dễ thương value luôn đó nhá, các bạn nên dùng dịch vụ này đi hay phải biết luốn ấy. Ngoài ra các dịch vụ ở đây còn rất là chất lượng nên mình chấm cho 5 sao luôn.', 4, 2, 3, 5, 3, 4, '19:36:32', '2014-09-27', 1),
(4, 2, 'Dịch vụ hơi bị ổn... các bạn ạ, yeah. Mình cho 4 sao nhá.', 4, 4, 4, 3, 4, 4, '23:08:27', '2014-09-26', 0),
(4, 3, 'Các dịch vụ ở đây chưa được tốt nhất là về mặt vệ sinh, nhưng được cái nhân viên rất thần thiện và dễ mếm, nên du di cho 3 sao nhá, cô lên.', 4, 1, 2, 5, 3, 3, '21:12:18', '2014-10-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_service`
--

CREATE TABLE IF NOT EXISTS `user_service` (
  `user_service_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_service_name` varchar(50) NOT NULL,
  `user_service_duration` int(11) NOT NULL,
  `user_service_full_price` varchar(50) NOT NULL,
  `user_service_sale_price` varchar(50) NOT NULL,
  `user_service_status` int(11) NOT NULL,
  `user_service_image` text NOT NULL,
  `user_service_description` text NOT NULL,
  `user_service_use_evoucher` int(11) NOT NULL DEFAULT '0',
  `user_service_is_featured` int(11) NOT NULL DEFAULT '0',
  `user_service_group_id` int(11) NOT NULL,
  `user_service_service_id` int(11) NOT NULL,
  `user_service_delete_flg` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `user_service`
--

INSERT INTO `user_service` (`user_service_id`, `user_service_name`, `user_service_duration`, `user_service_full_price`, `user_service_sale_price`, `user_service_status`, `user_service_image`, `user_service_description`, `user_service_use_evoucher`, `user_service_is_featured`, `user_service_group_id`, `user_service_service_id`, `user_service_delete_flg`) VALUES
(1, 'Cắt tóc Hàn Quốc dành cho nữ', 30, '400000', '350000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/73225-1920x1200.jpg', 'Đến với spa của chị Ngọc Trinh chúng ta sẽ được phục vụ tận tình, Spa bao gồm các dịch vụ về tóc, body...đồng thời khi đã là thành viên, quý khách sẽ được hưởng các ưu đãi có 1 không 2 của Spa, nhanh chân lên khi ưu đãi là có hạn', 0, 0, 1, 1, 1),
(2, 'Massage toàn thân trắng da mịn màng', 30, '450000', '400000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/20141012073134_images-2.jpg', 'Đến với spa của chị Ngọc Trinh chúng ta sẽ được phục vụ tận tình, Spa bao gồm các dịch vụ về tóc, body...đồng thời khi đã là thành viên, quý khách sẽ được hưởng các ưu đãi có 1 không 2 của Spa, nhanh chân lên khi ưu đãi là có hạn', 0, 0, 2, 5, 0),
(3, 'Massage mặt (bonus làm móng)', 80, '600000', '520000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/e266df_344b8d3569142667e34e9fb606d98fd12.jpg', 'Đến với spa của chị Ngọc Trinh chúng ta sẽ được phục vụ tận tình, Spa bao gồm các dịch vụ về tóc, body...đồng thời khi đã là thành viên, quý khách sẽ được hưởng các ưu đãi có 1 không 2 của Spa, nhanh chân lên khi ưu đãi là có hạn', 0, 1, 2, 4, 0),
(4, 'Cắt tóc cô dâu', 45, '400000', '350000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/hot-scissors-hair-cut1.jpg', 'Đến với spa của chị Ngọc Trinh chúng ta sẽ được phục vụ tận tình, Spa bao gồm các dịch vụ về tóc, body...đồng thời khi đã là thành viên, quý khách sẽ được hưởng các ưu đãi có 1 không 2 của Spa, nhanh chân lên khi ưu đãi là có hạn', 1, 1, 1, 1, 0),
(5, 'Làm móng Âu Mỹ', 40, '400000', '320000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/j-4.jpeg', 'Đến với spa của Hoàn Vũ chúng ta sẽ được phục vụ tận tình, Spa bao gồm các dịch vụ về móng...đồng thời khi đã là thành viên, quý khách sẽ được hưởng các ưu đãi có 1 không 2 của Spa, nhanh chân lên khi ưu đãi là có hạn', 0, 1, 3, 6, 0),
(6, 'Làm mặt (Massage)', 60, '400000', '380000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/3/Oxygen-Facial.jpg', 'Đến với spa Robot chúng ta sẽ được phục vụ tận tình, đội ngũ nhân viên của Spa nhanh nhẹn như Robot, Spa bao gồm các dịch vụ về làm mặt và Massage...đồng thời khi đã là thành viên, quý khách sẽ được hưởng các ưu đãi có 1 không 2 của Spa, nhanh chân lên khi ưu đãi là có hạn', 0, 1, 4, 7, 0),
(7, 'Thể dục thẩm mỹ kết hợp yoga', 60, '800000', '690000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/4/abhasa-spa-massage.jpg', 'Đến với Hallo chúng ta sẽ được phục vụ tận tình, đội ngũ nhân viên của Hallo nhanh nhẹn tận tâm, Salon bao gồm các dịch vụ về thể dục thẩm mỹ, chăm sóc body...đồng thời khi đã là thành viên, quý khách sẽ được hưởng các ưu đãi có 1 không 2 của Salon, nhanh chân lên khi ưu đãi là có hạn', 0, 0, 5, 8, 0),
(8, 'Cắt tóc chuyên nghiệp', 60, '600000', '520000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/262144-1920x1080.jpg', '', 0, 1, 1, 1, 1),
(9, 'Cắt tóc rối', 60, '420000', '400000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/262144-1920x1080.jpg', '', 0, 0, 1, 1, 1),
(10, 'Làm đầu Irak', 60, '600000', '520000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/bulle-zen-2.jpg', '', 0, 1, 1, 2, 0),
(11, 'Waxing chân, tay', 60, '320000', '285000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/262144-1920x1080.jpg', '', 0, 0, 1, 6, 1),
(12, 'Đắp mặt nạ thảo mộc', 60, '1200000', '1000000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/262144-1920x1080.jpg', '', 0, 0, 1, 1, 1),
(13, 'Uốn tóc kiểu Hàn Quốc', 60, '120000', '98000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/73225-1920x1200.jpg', '', 0, 0, 1, 5, 1),
(14, 'Cắt tóc chuyên nghiệp 2', 60, '600000', '410000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/73225-1920x1200.jpg', '', 0, 0, 1, 1, 1),
(15, 'Massage chân', 60, '200000', '150000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/73225-1920x1200.jpg', '', 0, 0, 1, 1, 1),
(16, 'Nhuộm da USA', 60, '580000', '480000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/73225-1920x1200.jpg', '', 0, 0, 6, 8, 1),
(17, 'Nhuộm tóc Hàn', 60, '152000', '120000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/262144-1920x1080.jpg', '', 0, 0, 1, 3, 1),
(18, 'Tắm trắng', 60, '1800000', '1710000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/262144-1920x1080.jpg', '', 0, 0, 1, 2, 1),
(19, 'Chăm sóc móng chuyên nghiệp', 60, '220000', '180000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/262144-1920x1080.jpg', '', 0, 0, 1, 1, 1),
(20, 'Làm đầu', 60, '125000', '85000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/2/262144-1920x1080.jpg', '', 0, 0, 1, 2, 1),
(21, 'Cắt tóc chuyên nghiệp', 60, '600000', '500000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/Short-Mohawk-Hairstyles-for-Boys.jpg', '', 0, 1, 6, 1, 0),
(22, 'Chăm sóc móng', 60, '600000', '580000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/unha2.jpg', '', 0, 1, 6, 6, 0),
(23, 'Cắt tóc Nhật Bản', 60, '600000', '380000', 1, 'https://s4.servinio.com:2083/cpsess5070142773/viewer/home/anfoodvn/public_html/beleza/public/assets/plugins/image-manager/upload/1/91706-1366x768.jpg', '', 0, 0, 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_service_review`
--

CREATE TABLE IF NOT EXISTS `user_service_review` (
  `user_service_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_service_review_value` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_service_id`,`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_service_review`
--

INSERT INTO `user_service_review` (`user_service_id`, `client_id`, `user_service_review_value`) VALUES
(1, 2, 4),
(1, 3, 4),
(2, 2, 3),
(2, 3, 4),
(3, 2, 5),
(3, 3, 2),
(4, 2, 4),
(4, 3, 5),
(5, 2, 4),
(6, 2, 4),
(7, 2, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
