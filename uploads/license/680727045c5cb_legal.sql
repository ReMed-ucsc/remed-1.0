-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2025 at 10:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4510132_remed`
--

-- --------------------------------------------------------

--
-- Table structure for table `legal`
--

CREATE TABLE `legal` (
  `privacy_policy` text NOT NULL,
  `terms_and_conditions` text NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `legal`
--

INSERT INTO `legal` (`privacy_policy`, `terms_and_conditions`, `Date`) VALUES
('Privacy Policy for ReMed\r\n\r\nLast Updated: 2025/04/20 \r\n\r\nWelcome to ReMed. Your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our application and services.\r\n\r\n1. Information We Collect\r\n\r\na. Personal Information\r\n   Full Name\r\n   Email Address\r\n   Phone Number\r\n   Date of Birth\r\n   Delivery Address\r\n   Prescription Details (including images and doctor information)\r\n\r\nb. Medical Information\r\n   Medication history\r\n   Allergies and known conditions\r\n   Health-related notes for prescriptions\r\n\r\nc. Usage Data\r\n   IP address\r\n   Device and browser type\r\n   Interaction with the app\r\n   Location (if enabled)\r\n\r\n2. How We Use Your Information\r\nWe use your data to:\r\n- Process and deliver your prescriptions\r\n- Send notifications about your orders\r\n- Contact you for health-related reminders\r\n- Provide customer support\r\n- Improve our services and app functionality\r\n- Comply with legal and regulatory requirements\r\n\r\n3. Sharing of Information\r\nWe do not sell or rent your personal data. We may share your data with:\r\n- Licensed pharmacies for prescription processing\r\n- Delivery partners for order fulfillment\r\n- Healthcare professionals when necessary\r\n- Legal authorities, if required by law\r\n\r\n4. Data Security\r\nWe implement industry-standard security measures including encryption and secure servers to protect your data. However, no method of transmission over the Internet or electronic storage is 100% secure.\r\n\r\n5. Your Rights\r\nYou have the right to:\r\n- Access your personal data\r\n- Request corrections or updates\r\n- Request deletion of your data (subject to legal requirements)\r\n- Withdraw consent at any time\r\n\r\nTo exercise your rights, contact us at: support@yourpharmacyapp.com\r\n\r\n6. Cookies and Tracking\r\nOur app may use cookies or similar technologies to enhance user experience and collect usage data. You can control cookie settings through your device or browser.\r\n\r\n7. Changes to This Policy\r\nWe may update this policy from time to time. We\'ll notify you about significant changes via email or app notifications.\r\n\r\n8. Contact Us\r\nIf you have any questions or concerns about this policy, please contact us at:\r\n\r\n', 'Terms and Conditions forReMed\r\n\r\n\r\nLast Updated: 2025/04/20\r\n\r\nWelcome to ReMed. By using our app and services, you agree to the following terms and conditions. Please read them carefully.\r\n\r\n1. Acceptance of Terms\r\nBy accessing or using this app, you agree to comply with and be bound by these Terms and Conditions and our Privacy Policy. If you do not agree, please do not use our services.\r\n\r\n2. Eligibility\r\nYou must be at least 18 years old to use this app. If you are under 18, a parent or guardian must register on your behalf and supervise your use of our services.\r\n\r\n3. Use of Services\r\nOur services include:\r\n- Ordering and delivery of prescribed medications\r\n- Access to pharmacy and health-related information\r\n- Notifications and reminders for medication\r\n\r\nYou agree to:\r\n- Provide accurate and complete information\r\n- Use the services only for lawful purposes\r\n- Not misuse, hack, or interfere with the app\r\n\r\n4. Prescription Requirements\r\nYou agree to upload a valid prescription for all medications that require one. We reserve the right to verify prescriptions and reject any order that does not comply with medical or legal standards.\r\n\r\n5. Intellectual Property\r\nAll content, trademarks, logos, and intellectual property in this app are the property of [Your Pharmacy App Name] and its licensors. You may not use or reproduce them without written permission.\r\n\r\n6. Limitation of Liability\r\nWe are not liable for:\r\n- Any side effects or health issues resulting from medication use\r\n- Errors in prescriptions provided by third parties\r\n- Delays in delivery caused by external factors\r\n\r\nOur liability is limited to the maximum extent permitted by law.\r\n\r\n7. Termination\r\nWe may suspend or terminate your access to the app at our discretion, especially if we believe you have violated these terms.\r\n\r\n8. Modifications\r\nWe reserve the right to update or change these Terms and Conditions at any time. Changes will be effective upon posting. Continued use after changes means you accept the revised terms.\r\n\r\n9. Governing Law\r\nThese Terms and Conditions shall be governed by and interpreted in accordance with the laws of [Insert Country/State].\r\n\r\n10. Contact Us\r\nIf you have questions about these Terms and Conditions, please contact us:\r\n\r\n\r\n\r\nBy using our services, you confirm that you have read, understood, and agreed to these Terms and Conditions.\r\n\r\n', '2025-04-21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
