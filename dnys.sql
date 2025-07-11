-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2025 at 12:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnys`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_text` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`) VALUES
(1, 1, 'Healing through natural methods', 1),
(2, 1, 'Surgical interventions', 0),
(3, 1, 'Pharmaceutical drug administration', 0),
(4, 1, 'Advanced medical imaging', 0),
(5, 2, 'Patanjali Yoga Sutras', 1),
(6, 2, 'Rig Veda', 0),
(7, 2, 'Bhagavad Gita', 0),
(8, 2, 'Upanishads', 0),
(9, 3, 'Water', 1),
(10, 3, 'Heat', 0),
(11, 3, 'Light', 0),
(12, 3, 'Sound', 0),
(13, 4, 'They represent the five basic elements of nature', 1),
(14, 4, 'They are five types of yoga asanas', 0),
(15, 4, 'They are five major human organs', 0),
(16, 4, 'They describe five stages of disease', 0),
(17, 5, 'Suppression of symptoms', 1),
(18, 5, 'The healing power of nature', 0),
(19, 5, 'Treat the whole person', 0),
(20, 5, 'Identify and treat the cause', 0),
(21, 6, 'Physical postures', 1),
(22, 6, 'Breathing techniques', 0),
(23, 6, 'Meditation practices', 0),
(24, 6, 'Ethical guidelines', 0),
(25, 7, 'Fundamental for healing and prevention', 1),
(26, 7, 'Only for weight loss', 0),
(27, 7, 'Irrelevant to treatment', 0),
(28, 7, 'Used only in severe cases', 0),
(29, 8, 'Breath control techniques', 1),
(30, 8, 'Chanting mantras', 0),
(31, 8, 'Complex physical exercises', 0),
(32, 8, 'Studying ancient scriptures', 0),
(33, 9, 'Mud Therapy', 1),
(34, 9, 'Sun Therapy', 0),
(35, 9, 'Water Therapy', 0),
(36, 9, 'Massage Therapy', 0),
(37, 10, 'Accumulated waste products in the body causing disease', 1),
(38, 10, 'Harmful bacteria only', 0),
(39, 10, 'External environmental pollutants only', 0),
(40, 10, 'Genetic predispositions to illness', 0),
(41, 11, 'Patanjali', 1),
(42, 11, 'Swami Vivekananda', 0),
(43, 11, 'Mahatma Gandhi', 0),
(44, 11, 'B.K.S. Iyengar', 0),
(45, 12, 'Allow the body to cleanse and heal', 1),
(46, 12, 'Increase appetite', 0),
(47, 12, 'Boost energy instantly', 0),
(48, 12, 'Promote muscle growth', 0),
(49, 13, 'Self-study (Svadhyaya)', 1),
(50, 13, 'Non-violence (Ahimsa)', 0),
(51, 13, 'Truthfulness (Satya)', 0),
(52, 13, 'Non-stealing (Asteya)', 0),
(53, 14, 'Light', 1),
(54, 14, 'Air', 0),
(55, 14, 'Earth', 0),
(56, 14, 'Sound', 0),
(57, 15, 'A temporary worsening of symptoms during detoxification', 1),
(58, 15, 'A sudden, severe illness', 0),
(59, 15, 'The point where a disease becomes incurable', 0),
(60, 15, 'A psychological breakdown due to stress', 0),
(61, 16, 'To purify the body and mind', 1),
(62, 16, 'To build muscle strength', 0),
(63, 16, 'To improve flexibility', 0),
(64, 16, 'To induce sleep', 0),
(65, 17, 'Enema or colon hydrotherapy', 1),
(66, 17, 'Antibiotics', 0),
(67, 17, 'Painkillers', 0),
(68, 17, 'Surgery', 0),
(69, 18, 'Purity, balance, and harmony', 1),
(70, 18, 'Activity, passion, and desire', 0),
(71, 18, 'Inertia, darkness, and ignorance', 0),
(72, 18, 'Physical strength', 0),
(73, 19, 'Applying pressure to specific points to stimulate healing', 1),
(74, 19, 'Using needles to stimulate points', 0),
(75, 19, 'Herbal poultices application', 0),
(76, 19, 'Sound wave therapy', 0),
(77, 20, 'Hatha Yoga', 1),
(78, 20, 'Raja Yoga', 0),
(79, 20, 'Bhakti Yoga', 0),
(80, 20, 'Jnana Yoga', 0),
(81, 21, 'Naturopathy', 1),
(82, 21, 'Allopathy', 0),
(83, 21, 'Surgery', 0),
(84, 21, 'Pharmacology', 0),
(85, 22, 'Energy centers in the body', 1),
(86, 22, 'Types of meditation mats', 0),
(87, 22, 'Specific yoga poses', 0),
(88, 22, 'Ancient yogic texts', 0),
(89, 23, 'Magnetotherapy', 1),
(90, 23, 'Hydrotherapy', 0),
(91, 23, 'Chromotherapy', 0),
(92, 23, 'Diet Therapy', 0),
(93, 24, 'Daily routine for health and well-being', 1),
(94, 24, 'Seasonal dietary changes', 0),
(95, 24, 'Specific meditation techniques', 0),
(96, 24, 'Herbal medicine preparations', 0),
(97, 25, 'To achieve mental tranquility and awareness', 1),
(98, 25, 'To increase physical endurance', 0),
(99, 25, 'To improve digestion', 0),
(100, 25, 'To strengthen muscles', 0),
(101, 26, 'Elimination of toxins through natural channels', 1),
(102, 26, 'Introduction of synthetic compounds', 0),
(103, 26, 'Surgical removal of diseased tissue', 0),
(104, 26, 'Suppression of immune response', 0),
(105, 27, 'Ethical restraints or moral disciplines', 1),
(106, 27, 'Breathing exercises', 0),
(107, 27, 'Physical postures', 0),
(108, 27, 'Concentration techniques', 0),
(109, 28, 'Provides essential nutrients for optimal health', 1),
(110, 28, 'Primarily for weight gain', 0),
(111, 28, 'Only for athletes', 0),
(112, 28, 'Irrelevant for chronic diseases', 0),
(113, 29, 'Hip Bath', 1),
(114, 29, 'Dry Sauna', 0),
(115, 29, 'Infrared Light Therapy', 0),
(116, 29, 'Acupuncture', 0),
(117, 30, 'Individual constitution or unique psycho-physiological makeup', 1),
(118, 30, 'The universal consciousness', 0),
(119, 30, 'A specific yoga pose', 0),
(120, 30, 'A type of herbal medicine', 0),
(121, 31, 'To improve circulation, reduce stress, and promote relaxation', 1),
(122, 31, 'To diagnose internal diseases', 0),
(123, 31, 'To administer medication topically', 0),
(124, 31, 'To induce fever', 0),
(125, 32, 'A state of contemplative absorption or superconsciousness', 1),
(126, 32, 'A specific breathing technique', 0),
(127, 32, 'A type of physical exercise', 0),
(128, 32, 'The initial stage of yoga practice', 0),
(129, 33, 'Vis Medicatrix Naturae (The Healing Power of Nature)', 1),
(130, 33, 'Suppression of symptoms', 0),
(131, 33, 'External intervention only', 0),
(132, 33, 'Symptomatic relief', 0),
(133, 34, 'Full-body warm-up and flexibility', 1),
(134, 34, 'Deep meditation', 0),
(135, 34, 'Cleansing the nasal passages', 0),
(136, 34, 'Improving eyesight only', 0),
(137, 35, 'Fresh fruits and vegetables', 1),
(138, 35, 'Processed snacks', 0),
(139, 35, 'Artificially flavored drinks', 0),
(140, 35, 'Fast food meals', 0),
(141, 36, 'Selfless action and duty', 1),
(142, 36, 'Devotion to a deity', 0),
(143, 36, 'Intellectual inquiry', 0),
(144, 36, 'Physical purification', 0),
(145, 37, 'Utilizing plant-based remedies for healing', 1),
(146, 37, 'Synthetic drug development', 0),
(147, 37, 'Surgical procedures', 0),
(148, 37, 'Genetic engineering', 0),
(149, 38, 'Shatkarma (Kriyas)', 1),
(150, 38, 'Asana', 0),
(151, 38, 'Pranayama', 0),
(152, 38, 'Dhyana', 0),
(153, 39, 'Allows the body to repair and regenerate', 1),
(154, 39, 'Increases stress levels', 0),
(155, 39, 'Slows down metabolism', 0),
(156, 39, 'Has no impact on health', 0),
(157, 40, 'Ayurveda', 1),
(158, 40, 'Traditional Chinese Medicine', 0),
(159, 40, 'Homeopathy', 0),
(160, 40, 'Western Medicine', 0),
(161, 41, 'Dietary changes, hydrotherapy, and lifestyle modifications', 1),
(162, 41, 'Long-term opioid use', 0),
(163, 41, 'Frequent surgical interventions', 0),
(164, 41, 'Ignoring the pain', 0),
(165, 42, 'Concentration on a single point or object', 1),
(166, 42, 'Withdrawal of senses', 0),
(167, 42, 'Meditation', 0),
(168, 42, 'Ethical observances', 0),
(169, 43, 'To remove earwax and toxins from the ear canal', 1),
(170, 43, 'To improve hearing directly', 0),
(171, 43, 'To treat ear infections with heat', 0),
(172, 43, 'To balance inner ear fluid', 0),
(173, 44, 'Mudras', 1),
(174, 44, 'Bandhas', 0),
(175, 44, 'Kriyas', 0),
(176, 44, 'Asanas', 0),
(177, 45, 'The body\'s inherent life force and healing capacity', 1),
(178, 45, 'Physical strength only', 0),
(179, 45, 'Mental alertness only', 0),
(180, 45, 'The speed of metabolism', 0),
(181, 46, 'Withdrawal of the senses from external objects', 1),
(182, 46, 'Increased physical flexibility', 0),
(183, 46, 'Improved cardiovascular health', 0),
(184, 46, 'Enhanced vocal abilities', 0),
(185, 47, 'A beneficial healing response of the body', 1),
(186, 47, 'Always a dangerous symptom to be suppressed', 0),
(187, 47, 'A sign of immediate organ failure', 0),
(188, 47, 'An indication for immediate surgery', 0),
(189, 48, 'Energetic locks or internal muscular contractions', 1),
(190, 48, 'External physical restraints', 0),
(191, 48, 'Types of meditation cushions', 0),
(192, 48, 'Chanting specific sounds', 0),
(193, 49, 'Major invasive surgery', 1),
(194, 49, 'Nutritional counseling', 0),
(195, 49, 'Herbal remedies', 0),
(196, 49, 'Lifestyle modification', 0),
(197, 50, 'Self-realization and liberation (Moksha)', 1),
(198, 50, 'Achieving physical perfection', 0),
(199, 50, 'Accumulating wealth', 0),
(200, 50, 'Gaining social status', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `content`, `author_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'प्रकृति की शक्ति: नेचुरोपैथी क्या है? एक शुरुआती मार्गदर्शिका', 'what-is-naturopathy', 'क्या आप एक ऐसी उपचार पद्धति की तलाश में हैं जो आपके शरीर को प्राकृतिक रूप से ठीक होने में मदद करे? क्या आप रसायनों और दवाओं से मुक्त एक स्वस्थ जीवनशैली अपनाना चाहते हैं? यदि हाँ, तो नेचुरोपैथी (Naturopathy) आपके लिए एक अद्भुत विकल्प हो सकती है। भारत की प्राचीन चिकित्सा प्रणालियों से प्रेरित और प्रकृति के सिद्धांतों पर आधारित, नेचुरोपैथी एक समग्र दृष्टिकोण है जो स्वास्थ्य और कल्याण को बढ़ावा देता है। इस विस्तृत मार्गदर्शिका में, हम जानेंगे कि नेचुरोपैथी क्या है, इसके मूल सिद्धांत क्या हैं और यह आपके जीवन को कैसे बदल सकती है।\r\n\r\n<h2>नेचुरोपैथी क्या है?</h2>\r\n\r\n<p>नेचुरोपैथी, जिसे प्राकृतिक चिकित्सा भी कहा जाता है, चिकित्सा की एक ऐसी प्रणाली है जो शरीर की अपनी उपचार क्षमता पर विश्वास करती है। यह केवल बीमारी के लक्षणों का इलाज करने के बजाय, बीमारी के मूल कारण को संबोधित करने पर केंद्रित है। नेचुरोपैथी का मानना है कि मानव शरीर में स्वयं को ठीक करने की अद्भुत क्षमता होती है, बशर्ते उसे सही वातावरण और सहायता मिले। यह प्रणाली आहार, जीवनशैली, जल चिकित्सा, योग, ध्यान और विभिन्न प्राकृतिक उपचारों का उपयोग करके स्वास्थ्य को बहाल करने और बनाए रखने पर जोर देती है। यह एक समग्र दृष्टिकोण है जो व्यक्ति के शारीरिक, मानसिक, भावनात्मक और आध्यात्मिक पहलुओं को ध्यान में रखता है।</p>\r\n\r\n<h3>नेचुरोपैथी के मूल सिद्धांत</h3>\r\n\r\n<p>नेचुरोपैथी कुछ मूलभूत सिद्धांतों पर आधारित है जो इसके अभ्यास को निर्देशित करते हैं:</p>\r\n\r\n<ul>\r\n    <li><strong>प्रकृति की उपचार शक्ति में विश्वास (The Healing Power of Nature):</strong> यह सबसे महत्वपूर्ण सिद्धांत है। नेचुरोपैथी का मानना है कि शरीर में खुद को ठीक करने की आंतरिक क्षमता होती है। नेचुरोपैथिक चिकित्सक इस जन्मजात उपचार क्षमता को सुविधाजनक बनाने के लिए काम करते हैं।</li>\r\n    <li><strong>कारण की पहचान और उपचार (Identify and Treat the Cause):</strong> नेचुरोपैथी बीमारी के लक्षणों को दबाने के बजाय, उसके अंतर्निहित कारण की पहचान करने और उसे संबोधित करने पर केंद्रित है। यह बीमारी को एक संकेत मानता है कि शरीर में कुछ असंतुलन है।</li>\r\n    <li><strong>कोई नुकसान न पहुँचाएँ (First Do No Harm):</strong> नेचुरोपैथिक चिकित्सक सुरक्षित, प्रभावी और न्यूनतम इनवेसिव उपचार विधियों का उपयोग करते हैं। वे ऐसे उपचारों से बचते हैं जो शरीर को और नुकसान पहुंचा सकते हैं।</li>\r\n    <li><strong>संपूर्ण व्यक्ति का उपचार (Treat the Whole Person):</strong> नेचुरोपैथी व्यक्ति को एक अविभाज्य इकाई के रूप में देखती है, जिसमें शारीरिक, मानसिक, भावनात्मक और आध्यात्मिक पहलू शामिल हैं। उपचार योजना व्यक्ति की अनूठी आवश्यकताओं और परिस्थितियों के अनुरूप बनाई जाती है।</li>\r\n    <li><strong>एक शिक्षक के रूप में चिकित्सक (Doctor as Teacher):</strong> नेचुरोपैथिक चिकित्सक रोगियों को उनके स्वास्थ्य के बारे में शिक्षित करते हैं और उन्हें स्वस्थ जीवनशैली विकल्प बनाने के लिए सशक्त बनाते हैं। वे रोगियों को अपनी स्वास्थ्य यात्रा में सक्रिय भूमिका निभाने के लिए प्रोत्साहित करते हैं।</li>\r\n    <li><strong>रोकथाम सर्वोपरि (Prevention is the Best Cure):</strong> नेचुरोपैथी बीमारी की रोकथाम पर बहुत जोर देती है। यह स्वस्थ आदतों और जीवनशैली विकल्पों को बढ़ावा देकर बीमारी के जोखिम को कम करने पर केंद्रित है।</li>\r\n</ul>\r\n\r\n<h3>नेचुरोपैथी में उपयोग की जाने वाली प्रमुख उपचार विधियाँ</h3>\r\n\r\n<p>नेचुरोपैथी विभिन्न प्रकार के प्राकृतिक उपचारों और तकनीकों का उपयोग करती है। कुछ प्रमुख विधियाँ इस प्रकार हैं:</p>\r\n\r\n<h4>आहार चिकित्सा (Diet Therapy)</h4>\r\n<p>नेचुरोपैथी में भोजन को दवा के रूप में देखा जाता है। संतुलित, प्राकृतिक और पौष्टिक आहार स्वस्थ जीवन का आधार है। इसमें शामिल हैं:</p>\r\n<ul>\r\n    <li><strong>कच्चे फल और सब्जियां:</strong> शरीर को डिटॉक्सिफाई करने और आवश्यक पोषक तत्व प्रदान करने में मदद करते हैं।</li>\r\n    <li><strong>साबुत अनाज:</strong> ऊर्जा और फाइबर प्रदान करते हैं।</li>\r\n    <li><strong>क्षारीय आहार:</strong> शरीर के pH संतुलन को बनाए रखने में मदद करता है।</li>\r\n    <li><strong>उपवास (Fasting):</strong> नियंत्रित उपवास शरीर को विषाक्त पदार्थों को बाहर निकालने और पाचन तंत्र को आराम देने में मदद कर सकता है।</li>\r\n</ul>\r\n\r\n<h4>जल चिकित्सा (Hydrotherapy)</h4>\r\n<p>जल चिकित्सा में विभिन्न तापमानों के पानी का उपयोग करके शरीर को ठीक किया जाता है। इसके कुछ सामान्य अनुप्रयोग हैं:</p>\r\n<ul>\r\n    <li><strong>स्नान (Baths):</strong> गर्म, ठंडा, या वैकल्पिक तापमान के स्नान दर्द को कम करने, रक्त संचार को बढ़ावा देने और तनाव से राहत दिलाने में मदद करते हैं।</li>\r\n    <li><strong>पैक (Packs):</strong> गीले पैक शरीर के विशिष्ट क्षेत्रों पर लगाए जाते हैं ताकि सूजन कम हो सके या रक्त प्रवाह बढ़ाया जा सके।</li>\r\n    <li><strong>एनिमा और कोलन हाइड्रोथेरेपी:</strong> पाचन तंत्र को साफ करने में मदद करते हैं।</li>\r\n</ul>\r\n\r\n<h4>योग और प्राणायाम (Yoga and Pranayama)</h4>\r\n<p>योग आसन (शारीरिक मुद्राएं) और प्राणायाम (श्वास व्यायाम) शारीरिक और मानसिक स्वास्थ्य के लिए महत्वपूर्ण हैं। ये तनाव कम करने, लचीलापन बढ़ाने, रक्त संचार में सुधार करने और आंतरिक शांति प्रदान करने में मदद करते हैं।</p>\r\n\r\n<h4>मालिश चिकित्सा (Massage Therapy)</h4>\r\n<p>मालिश मांसपेशियों के तनाव को कम करने, रक्त संचार में सुधार करने, दर्द से राहत दिलाने और विश्राम को बढ़ावा देने में मदद करती है। विभिन्न प्रकार की मालिश तकनीकों का उपयोग किया जाता है, जैसे कि आयुर्वेदिक मालिश, डीप टिश्यू मालिश, आदि।</p>\r\n\r\n<h4>मिट्टी चिकित्सा (Mud Therapy)</h4>\r\n<p>मिट्टी के औषधीय गुण होते हैं जो शरीर को डिटॉक्सिफाई करने और त्वचा संबंधी समस्याओं का इलाज करने में मदद करते हैं। ठंडी मिट्टी का लेप शरीर पर लगाया जाता है जो सूजन कम करने और रक्त संचार को उत्तेजित करने में प्रभावी होता है।</p>\r\n\r\n<h4>सूर्य चिकित्सा (Heliotherapy/Sun Bathing)</h4>\r\n<p>सूर्य के प्रकाश का उपयोग विभिन्न स्वास्थ्य लाभों के लिए किया जाता है, विशेष रूप से विटामिन डी के उत्पादन के लिए, जो हड्डियों के स्वास्थ्य और प्रतिरक्षा प्रणाली के लिए महत्वपूर्ण है।</p>\r\n\r\n<h4>एक्यूपंक्चर और एक्यूप्रेशर (Acupuncture and Acupressure)</h4>\r\n<p>ये प्राचीन चीनी चिकित्सा पद्धतियां शरीर के विशिष्ट बिंदुओं पर दबाव या सुइयों का उपयोग करके ऊर्जा के प्रवाह को संतुलित करती हैं, जिससे दर्द से राहत मिलती है और समग्र स्वास्थ्य में सुधार होता है।</p>\r\n\r\n<h3>नेचुरोपैथी के लाभ</h3>\r\n\r\n<p>नेचुरोपैथी के कई संभावित लाभ हैं, जिनमें शामिल हैं:</p>\r\n<ul>\r\n    <li><strong>समग्र स्वास्थ्य में सुधार:</strong> यह शारीरिक, मानसिक और भावनात्मक कल्याण को बढ़ावा देता है।</li>\r\n    <li><strong>बीमारी की रोकथाम:</strong> स्वस्थ जीवनशैली की आदतों को बढ़ावा देकर बीमारियों को रोकने में मदद करता है।</li>\r\n    <li><strong>पुरानी बीमारियों का प्रबंधन:</strong> मधुमेह, उच्च रक्तचाप, गठिया और पाचन संबंधी समस्याओं जैसी पुरानी बीमारियों के प्रबंधन में सहायक।</li>\r\n    <li><strong>दवाओं पर निर्भरता कम करना:</strong> प्राकृतिक उपचारों पर जोर देकर दवाओं के साइड इफेक्ट्स से बचा जा सकता है।</li>\r\n    <li><strong>डिटॉक्सिफिकेशन:</strong> शरीर से विषाक्त पदार्थों को निकालने में मदद करता है।</li>\r\n    <li><strong>तनाव और चिंता में कमी:</strong> योग, ध्यान और विश्राम तकनीकों के माध्यम से मानसिक शांति प्राप्त करने में मदद करता है।</li>\r\n    <li><strong>ऊर्जा स्तर में वृद्धि:</strong> स्वस्थ आहार और जीवनशैली से ऊर्जा और जीवन शक्ति बढ़ती है।</li>\r\n</ul>\r\n\r\n<h3>नेचुरोपैथी किसके लिए है?</h3>\r\n<p>नेचुरोपैथी उन व्यक्तियों के लिए उपयुक्त है जो एक समग्र और प्राकृतिक दृष्टिकोण के माध्यम से अपने स्वास्थ्य को बेहतर बनाना चाहते हैं। यह उन लोगों के लिए विशेष रूप से फायदेमंद हो सकता है जो:</p>\r\n<ul>\r\n    <li>पुरानी स्वास्थ्य समस्याओं से पीड़ित हैं।</li>\r\n    <li>दवाओं के दुष्प्रभावों से बचना चाहते हैं।</li>\r\n    <li>स्वस्थ जीवनशैली की आदतों को अपनाना चाहते हैं।</li>\r\n    <li>अपने शरीर की प्राकृतिक उपचार क्षमता को बढ़ाना चाहते हैं।</li>\r\n    <li>तनाव और चिंता को स्वाभाविक रूप से प्रबंधित करना चाहते हैं।</li>\r\n</ul>\r\n\r\n<p>यह ध्यान रखना महत्वपूर्ण है कि गंभीर या आपातकालीन चिकित्सा स्थितियों के लिए नेचुरोपैथी को पारंपरिक चिकित्सा के विकल्प के रूप में नहीं देखा जाना चाहिए। यह पारंपरिक उपचारों के पूरक के रूप में सबसे अच्छा काम करता है।</p>\r\n\r\n<h2>निष्कर्ष</h2>\r\n<p>नेचुरोपैथी एक शक्तिशाली और प्राचीन उपचार पद्धति है जो प्रकृति के साथ सामंजस्य स्थापित करके स्वास्थ्य और कल्याण को बढ़ावा देती है। यह आपको अपनी स्वास्थ्य यात्रा का नियंत्रण लेने और प्राकृतिक रूप से स्वस्थ जीवन जीने के लिए सशक्त बनाती है। आहार, जीवनशैली, जल चिकित्सा और योग जैसे प्राकृतिक उपचारों के माध्यम से, नेचुरोपैथी शरीर की आंतरिक उपचार शक्ति को जागृत करती है। यदि आप एक संतुलित, स्वस्थ और प्राकृतिक जीवन जीना चाहते हैं, तो नेचुरोपैथी की दुनिया में कदम रखना आपके लिए एक सार्थक अनुभव हो सकता है। प्रकृति की ओर लौटें और उसके उपचारात्मक स्पर्श का अनुभव करें!</p>\r\n\r\n<p>हमें बताएं, नेचुरोपैथी के बारे में आपका क्या विचार है? क्या आपने कभी प्राकृतिक चिकित्सा का अनुभव किया है? नीचे टिप्पणी करके अपने विचार और अनुभव साझा करें!</p>\r\n', 1, 'published', '2025-07-08 16:26:38', '2025-07-08 16:31:14'),
(3, 'योगिक विज्ञान के 10 अद्भुत लाभ: स्वस्थ जीवन का रहस्य | आयुर्वेद और योग', 'benefits-of-naturopathy', 'नमस्ते! आज की भागदौड़ भरी जिंदगी में हम सभी तनाव, बीमारियों और असंतुलन से जूझ रहे हैं। ऐसे में, प्राचीन भारतीय विज्ञान, <strong>योगिक विज्ञान (Yogic Science)</strong>, हमें एक स्वस्थ और संतुलित जीवन जीने का मार्ग दिखाता है। योग केवल कुछ शारीरिक आसन नहीं हैं, बल्कि यह एक संपूर्ण जीवन शैली है जो मन, शरीर और आत्मा को एक साथ जोड़ती है। आयुर्वेद भी योग को स्वास्थ्य बनाए रखने का एक महत्वपूर्ण स्तंभ मानता है। इस ब्लॉग पोस्ट में हम योगिक विज्ञान के 10 ऐसे अविश्वसनीय लाभों के बारे में जानेंगे जो शायद आपको हैरान कर दें। तो आइए, हमारे साथ इस आध्यात्मिक और शारीरिक यात्रा पर चलें और जानें कि योग कैसे आपके जीवन को बदल सकता है।\r\n\r\n    <h2>योगिक विज्ञान क्या है?</h2>\r\n    <p>योगिक विज्ञान, जिसे अक्सर सिर्फ \'योग\' कहा जाता है, एक प्राचीन भारतीय अभ्यास है जो शारीरिक, मानसिक और आध्यात्मिक भलाई को बढ़ावा देता है। यह हज़ारों साल पहले भारत में ऋषि-मुनियों द्वारा विकसित किया गया था। इसका उद्देश्य व्यक्तिगत चेतना को ब्रह्मांडीय चेतना से जोड़ना है। महर्षि पतंजलि के \"योग सूत्र\" में योग के आठ अंग (अष्टांग योग) बताए गए हैं: यम, नियम, आसन, प्राणायाम, प्रत्याहार, धारणा, ध्यान और समाधि। योगिक विज्ञान सिर्फ आसनों तक सीमित नहीं है, बल्कि इसमें श्वास नियंत्रण (प्राणायाम), ध्यान (मेडिटेशन), और नैतिक सिद्धांत भी शामिल हैं। आयुर्वेद के अनुसार, योग शरीर के त्रिदोषों (वात, पित्त, कफ) को संतुलित करने में मदद करता है, जिससे रोगों से बचाव होता है और स्वास्थ्य में सुधार होता है।</p>\r\n\r\n    <h2>योगिक विज्ञान के 10 अद्भुत लाभ</h2>\r\n\r\n    <h3>1. तनाव और चिंता से मुक्ति (तनाव प्रबंधन)</h3>\r\n    <p>आजकल तनाव और चिंता हर किसी के जीवन का हिस्सा बन गए हैं। योगिक विज्ञान, विशेषकर प्राणायाम और ध्यान, कोर्टिसोल (तनाव हार्मोन) के स्तर को कम करने में मदद करता है। नियमित अभ्यास से मन शांत होता है, चिंता कम होती है और आप अधिक केंद्रित महसूस करते हैं। <em>योग निद्रा</em> जैसे अभ्यास गहरी विश्राम प्रदान करते हैं जो मानसिक शांति के लिए अत्यंत लाभकारी है।</p>\r\n\r\n    <h3>2. शारीरिक शक्ति और लचीलेपन में वृद्धि</h3>\r\n    <p>योग के आसन मांसपेशियों को मजबूत बनाते हैं और शरीर के लचीलेपन को बढ़ाते हैं। नियमित रूप से योग करने से जोड़ों का दर्द कम होता है और शरीर की मुद्रा में सुधार आता है। सूर्य नमस्कार, भुजंगासन और त्रिकोणासन जैसे आसन आपकी शारीरिक क्षमता को बढ़ाते हैं। यह विशेष रूप से उन लोगों के लिए फायदेमंद है जो लंबे समय तक बैठे रहते हैं।</p>\r\n\r\n    <h3>3. बेहतर पाचन क्रिया और चयापचय</h3>\r\n    <p>योग के कई आसन, जैसे पवनमुक्तासन और मंडूकासन, पाचन अंगों की मालिश करते हैं और रक्त संचार को बेहतर बनाते हैं। इससे पाचन संबंधी समस्याएं जैसे कब्ज, अपच और गैस से राहत मिलती है। योग चयापचय (मेटाबॉलिज्म) को भी तेज करता है, जिससे वजन नियंत्रण में मदद मिलती है। आयुर्वेद भी स्वस्थ पाचन को अच्छे स्वास्थ्य की नींव मानता है।</p>\r\n\r\n    <h3>4. श्वसन प्रणाली में सुधार (प्राणायाम के लाभ)</h3>\r\n    <p>प्राणायाम (श्वास व्यायाम) फेफड़ों की क्षमता को बढ़ाता है और श्वसन प्रणाली को मजबूत करता है। अनुलोम-विलोम और कपालभाति जैसे प्राणायाम से शरीर में ऑक्सीजन का प्रवाह बढ़ता है, जिससे ऊर्जा का स्तर बढ़ता है और फेफड़ों से संबंधित बीमारियों का खतरा कम होता है। यह अस्थमा और ब्रोंकाइटिस के रोगियों के लिए विशेष रूप से फायदेमंद है।</p>\r\n\r\n    <h3>5. अच्छी नींद और अनिद्रा से राहत</h3>\r\n    <p>यदि आप अनिद्रा से जूझ रहे हैं, तो योग आपके लिए वरदान साबित हो सकता है। योगिक विज्ञान मन को शांत करता है, जिससे सोने में आसानी होती है और नींद की गुणवत्ता में सुधार होता है। शवासन और भ्रामरी प्राणायाम सोने से पहले करने से गहरी और आरामदायक नींद आती है।</p>\r\n\r\n    <h3>6. हृदय स्वास्थ्य को बढ़ावा</h3>\r\n    <p>योगिक अभ्यास रक्तचाप को नियंत्रित करने, कोलेस्ट्रॉल के स्तर को कम करने और हृदय गति को सामान्य रखने में मदद करता है। मंडूकासन और ताड़ासन जैसे आसन हृदय स्वास्थ्य के लिए बहुत अच्छे माने जाते हैं। नियमित योग हृदय रोगों के जोखिम को कम करता है और संपूर्ण हृदय प्रणाली को स्वस्थ रखता है।</p>\r\n\r\n    <h3>7. मानसिक स्पष्टता और एकाग्रता में वृद्धि</h3>\r\n    <p>योग और ध्यान मन को शांत करते हैं और विचारों की भीड़ को कम करते हैं। इससे आपकी एकाग्रता बढ़ती है और निर्णय लेने की क्षमता में सुधार होता है। छात्रों और उन लोगों के लिए यह विशेष रूप से उपयोगी है जिन्हें अपने काम में अधिक ध्यान केंद्रित करने की आवश्यकता होती है। धारणा और ध्यान के अभ्यास से मानसिक स्पष्टता आती है।</p>\r\n\r\n    <h3>8. प्रतिरक्षा प्रणाली को मजबूत बनाना</h3>\r\n    <p>नियमित योगिक अभ्यास शरीर की प्रतिरक्षा प्रणाली को मजबूत करता है। यह तनाव को कम करके और रक्त संचार को बढ़ाकर शरीर को बीमारियों से लड़ने में मदद करता है। आयुर्वेद के अनुसार, संतुलित दोष और मजबूत अग्नि (पाचन अग्नि) एक मजबूत प्रतिरक्षा प्रणाली की ओर ले जाती है, जिसमें योग एक महत्वपूर्ण भूमिका निभाता है।</p>\r\n\r\n    <h3>9. भावनात्मक संतुलन और मूड में सुधार</h3>\r\n    <p>योग केवल शारीरिक व्यायाम नहीं है, बल्कि यह आपकी भावनाओं को भी संतुलित करता है। यह क्रोध, निराशा और उदासी जैसी नकारात्मक भावनाओं को कम करने में मदद करता है, और खुशी, शांति और कृतज्ञता जैसी सकारात्मक भावनाओं को बढ़ावा देता है। यह आपको अपनी भावनाओं को बेहतर ढंग से समझने और प्रबंधित करने में सक्षम बनाता है।</p>\r\n\r\n    <h3>10. आध्यात्मिक विकास और आत्म-जागरूकता</h3>\r\n    <p>योगिक विज्ञान का अंतिम लक्ष्य आध्यात्मिक विकास और आत्म-जागरूकता है। यह आपको अपने आंतरिक स्व से जुड़ने में मदद करता है, जीवन के गहरे अर्थों को समझने में सहायता करता है। ध्यान और समाधि के माध्यम से व्यक्ति परमानंद और आत्मज्ञान की स्थिति प्राप्त कर सकता है, जिससे जीवन में एक गहरा और अधिक संतोषजनक अनुभव प्राप्त होता है।</p>\r\n\r\n    <h2>निष्कर्ष</h2>\r\n    <p>योगिक विज्ञान केवल एक व्यायाम पद्धति नहीं है, बल्कि यह एक संपूर्ण जीवन दर्शन है जो हमें शारीरिक, मानसिक और आध्यात्मिक रूप से स्वस्थ रहने में मदद करता है। इस प्राचीन भारतीय ज्ञान ने हमें तनाव मुक्त जीवन जीने, शारीरिक शक्ति बढ़ाने, पाचन में सुधार करने और यहां तक कि हृदय स्वास्थ्य को बनाए रखने के लिए कई अनमोल उपकरण दिए हैं। आयुर्वेद के साथ मिलकर योग, स्वस्थ और दीर्घायु जीवन की कुंजी है। यदि आपने अभी तक योग को अपने जीवन का हिस्सा नहीं बनाया है, तो यह सही समय है। अपनी दिनचर्या में कुछ मिनटों के लिए ही सही, योग को शामिल करें और इसके अद्भुत लाभों का अनुभव करें।</p>\r\n\r\n    <p>क्या आपने कभी योगिक विज्ञान के इन लाभों का अनुभव किया है? नीचे कमेंट सेक्शन में अपने अनुभव साझा करें! इस पोस्ट को अपने दोस्तों और परिवार के साथ साझा करें ताकि वे भी योग के इन अद्भुत लाभों के बारे में जान सकें।</p>\r\n\r\n    <p>अधिक जानकारी के लिए, कृपया पतंजलि योग सूत्र और अन्य प्रामाणिक आयुर्वेदिक ग्रंथों का संदर्भ लें।</p>', 1, 'published', '2025-07-08 16:31:23', '2025-07-08 16:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `difficulty` enum('easy','medium','hard') DEFAULT 'medium',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `difficulty`, `created_at`) VALUES
(1, 'What is the primary focus of Naturopathy?', 'easy', '2025-07-08 10:39:32'),
(2, 'Which ancient Indian text is considered a foundational text for Yoga?', 'easy', '2025-07-08 10:39:33'),
(3, 'Hydrotherapy involves the use of which element for healing?', 'easy', '2025-07-08 10:39:33'),
(4, 'What is the significance of \"Pancha Mahabhutas\" in Naturopathy?', 'medium', '2025-07-08 10:39:33'),
(5, 'Which of the following is NOT a principle of Naturopathy?', 'medium', '2025-07-08 10:39:33'),
(6, 'The concept of \"Asanas\" in Yoga primarily refers to:', 'easy', '2025-07-08 10:39:33'),
(7, 'What role does diet and nutrition play in Naturopathy?', 'easy', '2025-07-08 10:39:33'),
(8, '\"Pranayama\" in Yogic science is primarily concerned with:', 'easy', '2025-07-08 10:39:33'),
(9, 'Which therapy involves the application of various types of mud for therapeutic purposes?', 'medium', '2025-07-08 10:39:33'),
(10, 'What is the concept of \"Toxins\" in Naturopathy?', 'medium', '2025-07-08 10:39:33'),
(11, 'The eight limbs of Ashtanga Yoga were systematized by:', 'medium', '2025-07-08 10:39:33'),
(12, 'Fasting is often used in Naturopathy to:', 'medium', '2025-07-08 10:39:33'),
(13, 'Which of these is a key component of \"Niyama\" in Ashtanga Yoga?', 'medium', '2025-07-08 10:39:33'),
(14, 'Sunlight therapy, or Chromotherapy, utilizes which natural element?', 'easy', '2025-07-08 10:39:33'),
(15, 'The concept of \"Healing Crisis\" in Naturopathy refers to:', 'hard', '2025-07-08 10:39:33'),
(16, 'What is the primary purpose of \"Kriyas\" (cleansing techniques) in Yoga?', 'medium', '2025-07-08 10:39:33'),
(17, 'Which of the following is a common naturopathic treatment for constipation?', 'medium', '2025-07-08 10:39:33'),
(18, 'The term \"Sattva\" in Yogic philosophy represents:', 'hard', '2025-07-08 10:39:33'),
(19, 'What is the role of \"Acupressure\" in Naturopathy?', 'medium', '2025-07-08 10:39:33'),
(20, 'Which branch of Yoga focuses primarily on physical postures and breathing exercises?', 'easy', '2025-07-08 10:39:33'),
(21, 'The principle \"First, Do No Harm\" is central to which healthcare philosophy?', 'medium', '2025-07-08 10:39:33'),
(22, 'What is the significance of \"Chakras\" in Yogic and Ayurvedic traditions?', 'medium', '2025-07-08 10:39:33'),
(23, 'Which therapy involves the use of magnets for healing purposes?', 'medium', '2025-07-08 10:39:33'),
(24, 'The concept of \"Dinacharya\" in Ayurveda and Naturopathy refers to:', 'hard', '2025-07-08 10:39:33'),
(25, 'What is the primary aim of \"Meditation\" in Yogic practice?', 'easy', '2025-07-08 10:39:33'),
(26, 'Which of the following is a core principle of Naturopathic detoxification?', 'medium', '2025-07-08 10:39:33'),
(27, 'The term \"Yama\" in Ashtanga Yoga refers to:', 'medium', '2025-07-08 10:39:33'),
(28, 'What is the significance of \"Balanced Diet\" in Naturopathy?', 'easy', '2025-07-08 10:39:33'),
(29, 'Which of these is a common type of Hydrotherapy application?', 'easy', '2025-07-08 10:39:33'),
(30, 'The concept of \"Prakriti\" in Ayurveda and Yogic science describes:', 'hard', '2025-07-08 10:39:33'),
(31, 'What is the role of \"Massage Therapy\" in Naturopathy?', 'medium', '2025-07-08 10:39:33'),
(32, 'The term \"Samadhi\" in Yoga refers to:', 'hard', '2025-07-08 10:39:33'),
(33, 'Which naturopathic principle emphasizes the body\'s inherent ability to heal itself?', 'easy', '2025-07-08 10:39:33'),
(34, 'What is the primary benefit of practicing \"Surya Namaskar\" (Sun Salutations)?', 'medium', '2025-07-08 10:39:33'),
(35, 'Which of these is considered a \"natural food\" in Naturopathy?', 'easy', '2025-07-08 10:39:33'),
(36, 'The concept of \"Karma Yoga\" focuses on:', 'medium', '2025-07-08 10:39:33'),
(37, 'What is the role of \"Herbal Medicine\" in Naturopathy?', 'medium', '2025-07-08 10:39:34'),
(38, '\"Neti\" (nasal cleansing) is a part of which Yogic practice?', 'medium', '2025-07-08 10:39:34'),
(39, 'What is the importance of \"Rest and Relaxation\" in Naturopathic healing?', 'easy', '2025-07-08 10:39:34'),
(40, 'The concept of \"Vata, Pitta, Kapha\" (Doshas) is central to which traditional system?', 'medium', '2025-07-08 10:39:34'),
(41, 'Which of these is a common naturopathic approach to managing chronic pain?', 'medium', '2025-07-08 10:39:34'),
(42, 'The term \"Dharana\" in Ashtanga Yoga refers to:', 'hard', '2025-07-08 10:39:34'),
(43, 'What is the role of \"Ear Candling\" in some naturopathic practices?', 'medium', '2025-07-08 10:39:34'),
(44, 'Which Yogic practice involves specific hand gestures?', 'medium', '2025-07-08 10:39:34'),
(45, 'The concept of \"Vitality\" in Naturopathy refers to:', 'medium', '2025-07-08 10:39:34'),
(46, 'Which of these is a benefit of practicing \"Pratyahara\" in Yoga?', 'hard', '2025-07-08 10:39:34'),
(47, 'What is the naturopathic view on fever?', 'hard', '2025-07-08 10:39:34'),
(48, 'The concept of \"Bandhas\" in Hatha Yoga primarily involves:', 'hard', '2025-07-08 10:39:34'),
(49, 'Which of the following is NOT a common therapeutic application of Naturopathy?', 'medium', '2025-07-08 10:39:34'),
(50, 'What is the ultimate goal of Yoga according to classical texts?', 'hard', '2025-07-08 10:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `passed` tinyint(1) NOT NULL DEFAULT 0,
  `test_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `static_pages`
--

CREATE TABLE `static_pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `last_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `static_pages`
--

INSERT INTO `static_pages` (`id`, `title`, `slug`, `content`, `last_updated_at`) VALUES
(1, 'Privacy Policy', 'privacy-policy', '<h2>Privacy Policy</h2><p>This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.</p><p><strong>Interpretation and Definitions</strong></p><p><strong>Interpretation</strong></p><p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p><p><strong>Definitions</strong></p><p>For the purposes of this Privacy Policy:</p><ul><li><strong>Account</strong> means a unique account created for You to access our Service or parts of our Service.</li><li><strong>Company</strong> (referred to as either \"the Company\", \"We\", \"Us\" or \"Our\" in this Agreement) refers to Diploma in Naturopathy and Yogic Science.</li><li><strong>Cookies</strong> are small files that are placed on Your computer, mobile device or any other device by a website, containing the details of Your browsing history on that website among its many uses.</li><li><strong>Country</strong> refers to: India</li><li><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a digital tablet.</li><li><strong>Personal Data</strong> is any information that relates to an identified or identifiable individual.</li><li><strong>Service</strong> refers to the Website.</li><li><strong>Service Provider</strong> means any natural or legal person who processes the data on behalf of the Company. It refers to third-party companies or individuals employed by the Company to facilitate the Service, to provide the Service on behalf of the Company, to perform services related to the Service or to assist the Company in analyzing how the Service is used.</li><li><strong>Usage Data</strong> refers to data collected automatically, either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</li><li><strong>Website</strong> refers to Diploma in Naturopathy and Yogic Science, accessible from [Your Website URL]</li><li><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</li></ul>', '2025-07-08 15:16:37'),
(2, 'Terms of Service', 'terms-of-service', '<h2>Terms of Service</h2><p>Please read these terms and conditions carefully before using Our Service.</p><p><strong>Interpretation and Definitions</strong></p><p><strong>Interpretation</strong></p><p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p><p><strong>Definitions</strong></p><p>For the purposes of these Terms and Conditions:</p><ul><li><strong>Affiliate</strong> means an entity that controls, is controlled by or is under common control with a party, where \"control\" means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.</li><li><strong>Company</strong> (referred to as either \"the Company\", \"We\", \"Us\" or \"Our\" in this Agreement) refers to Diploma in Naturopathy and Yogic Science.</li><li><strong>Country</strong> refers to: India</li><li><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a digital tablet.</li><li><strong>Service</strong> refers to the Website.</li><li><strong>Terms and Conditions</strong> (also referred as \"Terms\") mean these Terms and Conditions that form the entire agreement between You and the Company regarding the use of the Service.</li><li><strong>Third-party Social Media Service</strong> means any services or content (including data, information, products or services) provided by a third-party that may be displayed, included or made available by the Service.</li><li><strong>Website</strong> refers to Diploma in Naturopathy and Yogic Science, accessible from [Your Website URL]</li><li><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</li></ul>', '2025-07-08 15:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `student_responses`
--

CREATE TABLE `student_responses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_answer_id` int(11) DEFAULT NULL,
  `is_correct_response` tinyint(1) NOT NULL,
  `attempt_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` enum('student','admin') DEFAULT 'student',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$r5qIW/kMCr8qbpmRXF3AW.kEAs.AF6xSDmDjs4GHYkO30./2F3SdW', 'admin@example.com', 'Administrator', 'admin', '2025-07-08 11:14:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `static_pages`
--
ALTER TABLE `static_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `student_responses`
--
ALTER TABLE `student_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `selected_answer_id` (`selected_answer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `static_pages`
--
ALTER TABLE `static_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_responses`
--
ALTER TABLE `student_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_responses`
--
ALTER TABLE `student_responses`
  ADD CONSTRAINT `student_responses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_responses_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_responses_ibfk_3` FOREIGN KEY (`selected_answer_id`) REFERENCES `answers` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
