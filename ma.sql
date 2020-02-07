-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2019 at 10:12 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ma`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `add_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `approval` smallint(6) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`item_id`, `name`, `description`, `content`, `add_date`, `image`, `approval`, `cat_id`) VALUES
(40, 'الجزيرة تكذب نفسها.. مظاهرات مؤيدة للسيسي بالتليفزيون', 'أصيبت قناة الجزيرة بخيبة أمل شديدة، بعد فشل دعوتها المحرضة على إشاعة العنف فى مصر، فى ظل تزايد دعوات الإخوان الإرهابية للنزول للشوارع لتقويض الدولة المصرية وزعزعة استقرار البلاد.', '<p dir=\"RTL\">&nbsp;أصيبت قناة الجزيرة بخيبة أمل شديدة، بعد فشل دعوتها المحرضة على إشاعة العنف فى مصر، فى ظل تزايد دعوات الإخوان الإرهابية للنزول للشوارع لتقويض الدولة المصرية وزعزعة استقرار البلاد.</p>\n\n<div class=\"After_F_Paragraph\" id=\"After_F_Paragraph\">&nbsp;</div>\n\n<p dir=\"RTL\">ونشرت الجزيرة عبر حسابها بموقع التدوين المصغر تويتر، صورا من مظاهرات زعموا أنها تطالب برحيل الرئيس عبد الفتاح السيسى، فيما كتبوا تعليقا بالأسفل مفاده :&quot;مظاهرات مؤيدة للسيسى&quot;، ليظهر حجم الإرتباك الشديد الذى تعانى منه قناة الجزيرة الداعمة للإرهاب.</p>\n\n<div class=\"imgcontainer\">\n<div class=\"imgcontainer\"><br />\nالجزيرة</div>\n</div>\n\n<p dir=\"RTL\">وكشفت فيديوهات الفبركة والكذب والتدليس الواضح، الذى تقوم به القناة القطرية، لتحريض المصريين على النزول، وإشاعة العنف والفوضى فى الشوارع المصرية، فى ظل سيناريو محكم للضغط على الدولة المصرية، وتقويض النظام ومؤسسات الدولة، وهو المخطط الذى أفشله الشعب المصرى اليوم الجمعة.</p>\n\n<p dir=\"RTL\">فيما تجمع المصريون بكثافة فى المنصة بطريق النصر، رافعين الأعلام المصريين، ومرددين هتافات تحيا مصر، والسيسى، لدعم الرئيس وتجديد ثقتهم فيه، ضد محاولات إس<img alt=\"الجزيرة\" src=\"https://img.youm7.com/ArticleImgs/2019/9/27/42240-85073-الجزيرة.jpg\" style=\"float:right; height:677px; width:1233px\" title=\"الجزيرة\" />قاط الدولة.</p>', '2019-09-28', '15d8f853bbf89e.jpeg', 1, 26),
(41, 'خيبة أمل قنوات الإرهاب..', 'كشفت قناة \"وطن\" الإخوانية، عن وجهها القبيح، وإفلاسها، بعد ظهور وعى الشعب المصرى، وردهم على حملات قنوات الجماعة الإرهابية الممنهجة، التى حاولت فى الأيام السابقة النيل من الدولة المصرية.', '<p dir=\"RTL\">كشفت قناة &quot;وطن&quot; الإخوانية، عن وجهها القبيح، وإفلاسها، بعد ظهور وعى الشعب المصرى، وردهم على حملات قنوات الجماعة الإرهابية الممنهجة، التى حاولت فى الأيام السابقة النيل من الدولة المصرية.</p>\n\n<div class=\"After_F_Paragraph\" id=\"After_F_Paragraph\">&nbsp;</div>\n\n<div class=\"imgcontainer\" style=\"text-align:center\"><img alt=\"صورة قديمة\" src=\"https://img.youm7.com/ArticleImgs/2019/9/27/47823-صورة-قديمة.JPG\" style=\"height:333px; width:550px\" title=\"صورة قديمة\" /><br />\nصورة قديمة</div>\n\n<p dir=\"RTL\">&nbsp;</p>\n\n<p dir=\"RTL\">وقطعت القناة الإخوانية البث المباشر، واستعانت بفيديوهات قديمة، ترجع لأحداث 25 يناير، والتى يظهر فيها صور الرئيس الأسبق مبارك، وتاريخ 2011، والتى تكشف عن إفلاسهم وتدليسهم.</p>\n\n<div class=\"imgcontainer\" style=\"text-align:center\"><img alt=\"صورة من ثورة يناير\" src=\"https://img.youm7.com/ArticleImgs/2019/9/27/51317-صورة-من-ثورة-يناير.JPG\" style=\"height:314px; width:550px\" title=\"صورة من ثورة يناير\" /><br />\nصورة من ثورة يناير</div>\n\n<p dir=\"RTL\">&nbsp;</p>\n\n<p dir=\"RTL\">ويواصل جموع المواطنين توافدهم من مختلف محافظات الجمهورية إلى منطقة المنصة للمشاركة بتظاهرة &quot; فى حب مصر&quot; رافعين لافتات مكتوب عليها لا لإسقاط الدولة، ولا للإرهاب، مرددين هتافات مؤيدة لمؤسسات الدولة المصرية.</p>\n\n<p dir=\"RTL\">&nbsp;</p>\n\n<p dir=\"RTL\">يُذكر أن الدولة المصرية قد تعرضت لحملة ممنهجة خلال الأسابيع الماضية لنشر الشائعات وبث الأكاذيب حول مؤسسات الدولة الوطنية، فى محاولة من أعداء الوطن وقوى الشر لإثارة البلبة وزعزعة الأمن العام والاستقرار.</p>', '2019-09-28', '15d8f85ce676dd.jpeg', 1, 26),
(42, 'محمد رمضان فى طريقة للمنصة للمشاركة باحتفالات \"فى حب مصر\"', 'نشر الفنان محمد رمضان عبر صفحته الرسمية على فيس بوك فيديو مباشر وهو فى الطريق إلى المنصة.', '<div>نشر الفنان محمد رمضان عبر صفحته الرسمية على فيس بوك فيديو مباشر وهو فى الطريق إلى المنصة.</div>\n\n<div class=\"After_F_Paragraph\" id=\"After_F_Paragraph\">&nbsp;</div>\n\n<div>&nbsp;</div>\n\n<div>وحرص الفنان محمد رمضان على التقاط الصور مع معجبيه ومحبيه فى الشارع ودعا الجميع لمشاركته فى وقفة حب مصر أمام المنصة بمدينة نصر.</div>\n\n<div>&nbsp;</div>\n\n<div style=\"text-align:center\"><iframe frameborder=\"0\" height=\"800\" scrolling=\"no\" src=\"https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FRamadan%2Fvideos%2F2466920046876533%2F&amp;show_text=0&amp;width=267\" width=\"400\"></iframe></div>', '2019-09-28', '15d8f865e58478.jpeg', 1, 27),
(43, 'فيديو .. سموحة يتقدم على المقاولون العرب بهدف محمود عزت', 'نجح فريق سموحة فى التقدم على المقاولون العرب بهدف مقابل للاشئ أحرزه محمود عزت من ضربة رأس فى الدقيقة 31 من عمر المباراة المقامة بينهما فى الجولة الثانية من بطولة الدورى .', '<p dir=\"RTL\">نجح فريق سموحة فى التقدم على المقاولون العرب بهدف مقابل للاشئ أحرزه محمود عزت من ضربة رأس فى الدقيقة 31 من عمر المباراة المقامة بينهما فى الجولة الثانية من بطولة الدورى .</p>\n\n<div class=\"After_F_Paragraph\" id=\"After_F_Paragraph\">&nbsp;</div>\n\n<p dir=\"RTL\">وقد بدأ المقاولون العرب المباراة بتشكيل مكون من :-</p>\n\n<p dir=\"RTL\">حراسة المرمى : محمود أبو السعود</p>\n\n<p dir=\"RTL\">خط الدفاع : أمير عابد &ndash; محمد سمير &ndash; حسن الشامى &ndash; فاروقا &ndash; أحمد الشيمى</p>\n\n<p dir=\"RTL\">خط الوسط : إبراهيم صلاح &ndash; كريم مصطفى &ndash; عبد الله ياسين &ndash; طاهر محمد طاهر</p>\n\n<p dir=\"RTL\">خط الهجوم : سيف الجزيرى</p>\n\n<p dir=\"RTL\">بينما جاء تشكيل سموحه على النحو التالى :-</p>\n\n<p dir=\"RTL\">حراسة المرمى : الهانى سليمان</p>\n\n<p dir=\"RTL\">خط الدفاع : رجب نبيل &ndash; محمود عزت &ndash; إبراهيم عبد القوى &ndash; كريم يحيي</p>\n\n<p dir=\"RTL\">خط الوسط : يوسف ديوب &ndash; ناصر ماهر &ndash; شريف رضا &ndash; فوزى الحناوى</p>\n\n<p dir=\"RTL\">خط الهجوم : رونالدو أونجا &ndash; حسام حسن</p>\n\n<p dir=\"RTL\">يذكر أن المقاولون العرب يمتلك ثلاث نقاط في رصيده بعد تحقيق الفوز على طلائع الجيش بهدف نظيف في مباراة الجولة الأولى، فيما يبحث سموحة بقيادة حسام حسن عن أول نقاطه في مباراة اليوم، بعدما خسر ضربة البداية أمام الأهلي بهدف نظيف أيضاً.</p>\n\n<div><iframe frameborder=\"0\" height=\"100%\" src=\"https://streamable.com/s/l6rc3/hvyrrq\" width=\"100%\"></iframe></div>', '2019-09-28', '15d8f870544e3b.jpeg', 1, 28),
(44, 'تحربه عنوان', 'تفاصيل', '<p dir=\"RTL\">كشفت قناة &quot;وطن&quot; الإخوانية، عن وجهها القبيح، وإفلاسها، بعد ظهور وعى الشعب المصرى، وردهم على حملات قنوات الجماعة الإرهابية الممنهجة، التى حاولت فى الأيام السابقة النيل من الدولة المصرية.</p>\n\n<div class=\"After_F_Paragraph\" id=\"After_F_Paragraph\">&nbsp;</div>\n\n<div class=\"imgcontainer\" style=\"text-align:center\"><img alt=\"صورة قديمة\" class=\"img-fluid\" src=\"https://img.youm7.com/ArticleImgs/2019/9/27/47823-صورة-قديمة.JPG\" style=\"height:333px; width:550px\" title=\"صورة قديمة\" /><br />\nصورة قديمة</div>\n\n<p dir=\"RTL\">&nbsp;</p>\n\n<p dir=\"RTL\">وقطعت القناة الإخوانية البث المباشر، واستعانت بفيديوهات قديمة، ترجع لأحداث 25 يناير، والتى يظهر فيها صور الرئيس الأسبق مبارك، وتاريخ 2011، والتى تكشف عن إفلاسهم وتدليسهم.</p>\n\n<div class=\"imgcontainer\" style=\"text-align:center\"><img alt=\"صورة من ثورة يناير\" class=\"img-fluid\" src=\"https://img.youm7.com/ArticleImgs/2019/9/27/51317-صورة-من-ثورة-يناير.JPG\" style=\"height:314px; width:550px\" title=\"صورة من ثورة يناير\" /><br />\nصورة من ثورة يناير</div>\n\n<p dir=\"RTL\">&nbsp;</p>\n\n<p dir=\"RTL\">ويواصل جموع المواطنين توافدهم من مختلف محافظات الجمهورية إلى منطقة المنصة للمشاركة بتظاهرة &quot; فى حب مصر&quot; رافعين لافتات مكتوب عليها لا لإسقاط الدولة، ولا للإرهاب، مرددين هتافات مؤيدة لمؤسسات الدولة المصرية.</p>\n\n<p dir=\"RTL\">&nbsp;</p>\n\n<p dir=\"RTL\">يُذكر أن الدولة المصرية قد تعرضت لحملة ممنهجة خلال الأسابيع الماضية لنشر الشائعات وبث الأكاذيب حول مؤسسات الدولة الوطنية، فى محاولة من أعداء الوطن وقوى الشر لإثارة البلبة وزعزعة الأمن العام والاستقرار.</p>', '2019-10-31', '15dbac7c71e168.jpeg', 1, 30),
(45, 'new article', 'loreum ipsum dolar\r\n\r\n\r\nloreum ipsum dolar\r\nloreum ipsum dolarloreum ipsum dolar\r\n\r\nloreum ipsum dolar\r\nloreum ipsum dolar\r\nloreum ipsum dolar', '', '2019-11-01', '15dbc6bf15c26e.jpeg', 1, 31),
(46, 'new article', 'سove_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );', '', '2019-11-01', '15dbc6ee523305.jpeg', 1, 31),
(47, 'new article', 'move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );move_uploaded_file($tmpname , __DIR__ . \'/../uploaded_files/\' . $image_name );', '', '2019-11-01', '15dbc6f0a65d2d.jpeg', 1, 31),
(48, 'كبيرت بالعربى', 'سشيشسيسشيشسيسشيشسيسشيشسيسشيشسي\r\nسشيشسي\r\n\r\n\r\nسشيشسي\r\n\r\n\r\n\r\nسشيشسيسشيشسي\r\n\r\nسشيشسيسشيشسي', '', '2019-11-01', '15dbc756732dda.jpeg', 1, 32);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `name`) VALUES
(27, 'art'),
(29, 'blog'),
(31, 'new category'),
(26, 'news'),
(28, 'sports'),
(30, 'تجربه'),
(32, 'عربى');

-- --------------------------------------------------------

--
-- Table structure for table `email_subscribe`
--

CREATE TABLE `email_subscribe` (
  `email` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_subscribe`
--

INSERT INTO `email_subscribe` (`email`, `faculty`, `date`) VALUES
('amr@yahoo.com', 'face', '2019-10-31'),
('art@yahoo.com', 'my arti', '2019-10-24'),
('nmam@yahoo.com', 'my fac', '2019-10-24'),
('qqq@yahoo.com', 'qqq', '2019-10-24'),
('qqq@yahoo.coma', '', '2019-10-24'),
('qqq@yyya', 'wwwww', '2019-10-24'),
('qqqq@yahoo.com', '', '2019-10-24'),
('qqqq@yyya', 'wwwww', '2019-10-24'),
('t,m@yahoo.com', 'my facqq', '2019-10-24'),
('uuu@yahoo.com', '', '2019-10-31'),
('www@t\\yahoo.com', '', '2019-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `end_date` date NOT NULL,
  `facebook` text NOT NULL,
  `registeration` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `cover` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `topics` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `date`, `end_date`, `facebook`, `registeration`, `location`, `category`, `images`, `cover`, `status`, `phone`, `email`, `topics`) VALUES
(1, 'Name', 'descellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsis', '2019-09-30', '0000-00-00', '', '', 'Suez', 'cat', '1569880448ab78sawew415d9279b156c25.jpg,1569880448ab78sawew415d9279b12cdd4.jpg,1569880448ab78sawew415d9279b11da14.jpg,', '', 1, '151548748', 'mr_amal654@yahoo.com', 'topic,awe,qwer'),
(2, 'Namez', 'descellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsis', '2019-09-30', '0000-00-00', '', '', 'Suez', 'arts', '1569880448ab78sawew415d9279b156c25.jpg,1569880448ab78sawew415d9279b12cdd4.jpg,1569880448ab78sawew415d9279b11da14.jpg,', '', 1, '151548748', 'mr_amal654@yahoo.com', 'topic'),
(3, 'name', 'desc', '2019-10-09', '0000-00-00', '', '', 'suezz', 'cat', '', '', 1, '01018529485', 'a@yahoo.com', 'topic,name,tts'),
(4, 'Namez', 'descellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsisdescellipsisellipsisellipsisellipsisellipsisellipsisellipsisellipsis ellipsis ellipsis', '2019-09-30', '0000-00-00', '', '', 'Suez', 'arts', '1569880448ab78sawew415d9279b156c25.jpg,1569880448ab78sawew415d9279b12cdd4.jpg,1569880448ab78sawew415d9279b11da14.jpg,', '', 1, '151548748', 'mr_amal654@yahoo.com', 'topic'),
(5, 'Event', 'Desc', '2019-10-22', '0000-00-00', '', '', 'due', 'category', '1571754789ab78sawew415daf13e843911.jpg,1571754789ab78sawew415daf13e6cd603.png,1571754789ab78sawew415daf13e60b24d.jpg,1571754789ab78sawew415daf13e4f1867.jpg,', '', 1, '', '', ''),
(6, 'Event NAme', 'my description', '2018-10-24', '2019-10-25', '', '', 'Online', 'online', '1571925530ab78sawew415db1ae390b0fb.png,1571925530ab78sawew415db1ae38486f5.jpg,1571925530ab78sawew415db1ae3374217.png,1571925530ab78sawew415db1ae3298997.jpg,', '', 2, '', '', ''),
(7, 'new', 'new desc', '2019-10-26', '2019-10-27', 'https://www.facebook.com/amrahmed789', '', 'Online', 'category', '1571926090ab78sawew415db1b0548534a.jpg,1571926090ab78sawew415db1b053a9a83.jpg,1571926090ab78sawew415db1b052bff93.jpg,1571926090ab78sawew415db1b051ea099.jpg,1571926090ab78sawew415db1b05110854.jpg,', '', 0, '01148567855', 'email@yahoo.com', 'topic,news,technical'),
(8, 'New Name', 'NEw Description', '2019-10-24', '2019-10-25', '', 'https://www.facebook.com/amrahmed789', 'Online', 'Online', '1571930245ab78sawew415db1cb8f2a433.jpg,1571930245ab78sawew415db1cb8d758dd.png,1571930245ab78sawew415db1cb8c908ef.jpg,1571930245ab78sawew415db1cb8b39c84.jpg,', '15db1cc12cd80b.jpeg', 0, '', '', ''),
(9, 'event name', 'description', '2019-11-13', '2019-11-07', 'https://www.google.com', 'https://www.google.com', 'suez', 'online', '1572560021ab78sawew415dbb5d012de8b.jpg,1572560021ab78sawew415dbb5d0060f8c.jpg,1572560021ab78sawew415dbb5cfe6b65f.jpg,', '15dbb5d748416e.jpeg', 2, '01033677906', 'email@yahoo.com', 'topic,sss,qqq,qww');

-- --------------------------------------------------------

--
-- Table structure for table `events_speakers`
--

CREATE TABLE `events_speakers` (
  `event_id` int(11) NOT NULL,
  `speaker_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events_speakers`
--

INSERT INTO `events_speakers` (`event_id`, `speaker_id`) VALUES
(3, 2),
(3, 3),
(5, 2),
(5, 3),
(6, 2),
(7, 2),
(7, 3),
(9, 2),
(9, 3),
(9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `events_sponsorers`
--

CREATE TABLE `events_sponsorers` (
  `event_id` int(11) NOT NULL,
  `sponsor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events_sponsorers`
--

INSERT INTO `events_sponsorers` (`event_id`, `sponsor_id`) VALUES
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE `magazines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `description` text CHARACTER SET utf32 NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `magazines`
--

INSERT INTO `magazines` (`id`, `name`, `url`, `description`, `image`) VALUES
(6, 'Magazine NAme', 'http://online.anyflip.com/rczl/yitt/', 'desc', '15db2c2a2b071f.jpg'),
(7, 'Magazine NAme', 'http://online.anyflip.com/enio/xjdv/', 'wqeqe', '15db2e296b15d7.jpg'),
(8, 'NEw NAme', 'http://online.anyflip.com/wufel/njxk/', 'random', '15db2e354d3a62.png'),
(9, 'more item', 'http://online.anyflip.com/mbwx/xali/', 'sssssss', '15db2e3bcec240.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf32 NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`id`, `name`, `position`, `description`, `image`) VALUES
(2, 'Amr Ahmed', 'CEO talebshaqa', 'Description', '15d91ba22be79f.png'),
(3, 'Osama Ahmed', 'New', 'desc', '15d943a531db17.png'),
(4, 'asdasd', 'asd', 'asdasd', '15db2be29e69ad.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `title`, `image`) VALUES
(1, 'Amr Ahmed', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `groupID` int(11) NOT NULL,
  `TrustStatus` int(11) NOT NULL,
  `RegStatus` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `u_name`, `email`, `password`, `groupID`, `TrustStatus`, `RegStatus`, `date`) VALUES
(2, 'Amr Ahmed', 'admin@yahoo.com', '$2y$10$acXeYaXu2CvCqyuiOa3DQ.feUdWQA/zbfEyv0edI0hI8uqbreZBoW', 1, 0, 1, '0000-00-00'),
(19, 'user', 'user@yahoo.com', '$2y$10$sVNkQLbcXpM.GlEJIAlvMuanfr/lzkJG62soIpFEceYwkKdN67jh2', 0, 0, 1, '2019-08-31'),
(180, 'amr', 'new@yahoo.com', '$2y$10$a0bvos6BS7IZy6.eJss9l.fbFQNCCn2nrl86YlpYco3U22eK1mGja', 0, 0, 1, '2019-08-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `cat_cons` (`cat_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `email_subscribe`
--
ALTER TABLE `email_subscribe`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_speakers`
--
ALTER TABLE `events_speakers`
  ADD KEY `cons` (`event_id`),
  ADD KEY `speaker_cons` (`speaker_id`);

--
-- Indexes for table `events_sponsorers`
--
ALTER TABLE `events_sponsorers`
  ADD KEY `event_cons` (`event_id`),
  ADD KEY `sponsor_cons` (`sponsor_id`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `cat_cons` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events_speakers`
--
ALTER TABLE `events_speakers`
  ADD CONSTRAINT `cons` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `speaker_cons` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events_sponsorers`
--
ALTER TABLE `events_sponsorers`
  ADD CONSTRAINT `event_cons` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sponsor_cons` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
