-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2018 at 09:27 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutUs`
--

CREATE TABLE `aboutUs` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutUs`
--

INSERT INTO `aboutUs` (`id`, `header`, `keywords`, `content`) VALUES
(1, 'Pellentesque fermentum mauris', 'Vivamus accumsan blandit ligula. Sed lobortis efficitur sapien', 'Quisque vel sem eu turpis ullamcorper euismod. Praesent quis nisi ac augue luctus viverra. Sed et dui nisi. Fusce vitae dapibus justo. Pellentesque accumsan est ac posuere imperdiet. Curabitur eros mi, lacinia at euismod quis, dapibus vel ligula. Ut sodales erat vitae nunc tempor mollis. Donec tempor lobortis tortor, in feugiat massa facilisis sed. Ut dignissim viverra pretium. In eu justo maximus turpis feugiat finibus scelerisque nec eros.\n\nClassic Template provides a great flexibility to arrange the content in any way you like. Please tell your friends about templatemo. Nam sem neque, finibus id sem pharetra, cursus porttitor ligula. Praesent aliquam fermentum dui, vitae venenatis libero vulputate ac. Fusce bibendum scelerisque magna eget iaculis.'),
(2, 'Pellentesque fermentum mauris', 'Vivamus accumsan blandit ligula. Sed lobortis efficitur sapien', '<p>Nulla ultrices nibh ac accumsan lobortis. Nulla facilisi. Praesent velit\n ante, congue ac dignissim in, vehicula sit amet urna. Fusce in dapibus \nquam, eget finibus velit. Nullam erat odio, vulputate id est ut, \nconsequat rutrum justo. Vivamus vel leo vel nunc tincidunt mattis. Sed \nneque diam, semper suscipit dictum a, sodales ac metus. Class aptent \ntaciti sociosqu ad litora torquent per conubia nostra, per inceptos \nhimenaeos. Morbi vel pharetra massa, non iaculis tortor. Nulla porttitor\n tincidunt felis et feugiat. Vivamus fermentum ligula justo, sit amet \nblandit nisl volutpat id.\n</p>');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `name`, `description`) VALUES
(1, 'Lorem-ipsum-dolor-sit', 'Fusce in dapibus quam, eget finibus velit.'),
(2, 'Tincidunt-non-faucibus', 'Morbi vel pharetra massa, non iaculis tortor.'),
(3, 'placerat', ' Ut sodales erat vitae nunc tempor mollis'),
(4, 'Vestibulum-tempor-ac-lectus', 'sit amet blandit nisl volutpat id'),
(5, 'general', 'just for all purpose'),
(6, 'News', 'news news news');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `title`, `content`) VALUES
(1, 'Pellentesque fermentum mauris', 'Vivamus accumsan blandit ligula. Sed lobortis efficitur sapien. Quisque vel sem eu turpis ullamcorper euismod. Praesent quis nisi ac augue luctus viverra. Sed et dui nisi. Fusce vitae dapibus justo.'),
(2, 'Pellentesque fermentum mauris', '<p align=\"left\">Morbi vel pharetra massa, non iaculis tortor. Nulla porttitor \ntincidunt felis et feugiat. Vivamus fermentum ligula justo, sit amet \nblandit nisl volutpat id.</p><p align=\"left\">Donec mattis ipsum in erat viverra commodo.\n                        Proin sapien lacus, euismod eget nisl in,\n                        elementum posuere massa. Curabitur a odio\n                        eros. Cras aliquam lectus erat, non semper est\n                        volutpat eget. Ut eget erat tincidunt.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `headerImage`
--

CREATE TABLE `headerImage` (
  `id` varchar(10) NOT NULL,
  `extension` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headerImage`
--

INSERT INTO `headerImage` (`id`, `extension`) VALUES
('index', 'jpg'),
('aboutUs', 'jpg'),
('blog', 'jpg'),
('contact', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `homeIntro`
--

CREATE TABLE `homeIntro` (
  `id` varchar(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeIntro`
--

INSERT INTO `homeIntro` (`id`, `title`, `content`, `image`) VALUES
('head', 'Introduction', 'Aenean cursus tellus mauris, quis consequat mauris dapibus id. Donec scelerisque porttitor pharetra', 'none'),
('content1', 'Lorem ipsum dolor #139', 'Aenean cursus tellus mauris, quis consequat mauris dapibus id. Donec scelerisque porttitor pharetra', 'content1.jpg'),
('content2', 'Lorem ipsum dolor #2', 'Aenean cursus tellus mauris, quis consequat mauris dapibus id. Donec scelerisque porttitor pharetra', 'content2.jpg'),
('content3', 'Lorem ipsum dolor #3', 'Aenean cursus tellus mauris, quis consequat mauris dapibus id. Donec scelerisque porttitor pharetra', 'content3.jpg'),
('content4', 'Lorem ipsum dolor #4', 'Aenean cursus tellus mauris, quis consequat mauris dapibus id. Donec scelerisque porttitor pharetra', 'content4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `postCat`
--

CREATE TABLE `postCat` (
  `catName` varchar(255) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postCat`
--

INSERT INTO `postCat` (`catName`, `postId`) VALUES
('Tincidunt-non-faucibus', 3),
('placerat', 2),
('Vestibulum-tempor-ac-lectus', 4),
('general', 1),
('Lorem-ipsum-dolor-sit', 2),
('Lorem-ipsum-dolor-sit', 11),
('placerat', 11),
('Lorem-ipsum-dolor-sit', 8),
('placerat', 8),
('general', 8),
('Vestibulum-tempor-ac-lectus', 7),
('general', 7),
('News', 6);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `publicationDate` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `content` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `publicationDate`, `title`, `summary`, `content`, `image`) VALUES
(1, '2018-05-09', 'Pellentesque fermentum mauris', 'Vivamus accumsan blandit ligula. Sed lobortis efficitur sapien', 'You can help templatemo by telling your friends about our HTML CSS templates. Praesent velit ante, congue ac dignissim in, vehicula sit amet urna. Fusce in dapibus quam, eget finibus velit. Nullam erat odio, vulputate id est ut, consequat rutrum justo. Vivamus vel leo vel nunc tincidunt mattis. Sed neque diam, semper suscipit dictum a, sodales ac metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.\r\n\r\nMorbi vel pharetra massa, non iaculis tortor. Nulla porttitor tincidunt felis et feugiat. Vivamus fermentum ligula justo, sit amet blandit nisl volutpat id. Fusce sagittis ultricies felis, non luctus mauris lacinia quis. Ut fringilla lacus ac tempor ullamcorper. Mauris iaculis placerat ex et mattis.\r\n\r\nQuisque vel sem eu turpis ullamcorper euismod. Praesent quis nisi ac augue luctus viverra. Sed et dui nisi. Fusce vitae dapibus justo. Pellentesque accumsan est ac posuere imperdiet. Curabitur eros mi, lacinia at euismod quis, dapibus vel ligula. Ut sodales erat vitae nunc tempor mollis. Donec tempor lobortis tortor, in feugiat massa facilisis sed. Ut dignissim viverra pretium. In eu justo maximus turpis feugiat finibus scelerisque nec eros. Cras nec lectus tempor nibh vestibulum eleifend et ac elit.\r\n\r\nSed vitae luctus libero. Nam sem neque, finibus id sem pharetra, cursus porttitor ligula. Praesent aliquam fermentum dui, vitae venenatis libero vulputate ac. Fusce bibendum scelerisque magna eget iaculis. Phasellus non arcu eu sem convallis semper. Duis vulputate dignissim rhoncus.', '.jpg'),
(2, '2018-05-10', 'Lorem ipsum dolor #1', 'Aenean cursus tellus mauris, quis consequat mauris dapibus id. Donec scelerisque porttitor pharetra', 'Bootstrap includes 260 glyphs from the Glyphicon Halflings set. Glyphicons Halflings are normally not available for free, but their creator has made them available for Bootstrap free of cost. As a thank you, you should include a link back to Glyphicons whenever possible.\r\n\r\nUse glyphicons in text, buttons, toolbars, navigation, or forms:\r\nBootstrap includes 260 glyphs from the Glyphicon Halflings set. Glyphicons Halflings are normally not available for free, but their creator has made them available for Bootstrap free of cost. As a thank you, you should include a link back to Glyphicons whenever possible.\r\n\r\nUse glyphicons in text, buttons, toolbars, navigation, or forms:', '.jpg'),
(3, '2018-05-10', 'Lorem ipsum dolor #2', 'Aenean cursus tellus mauris, quis consequat mauris dapibus id. Donec scelerisque porttitor pharetra', 'Bed linen and towels are provided and laundered regularly by the house. All bedrooms and common areas are cleaned every weekday. Bed linen and towels are provided and laundered regularly by the house. All bedrooms and common areas are cleaned every weekday. Bed linen and towels are provided and laundered regularly by the house. All bedrooms and common areas are cleaned every weekday. Bed linen and towels are provided and laundered regularly by the house. All bedrooms and common areas are cleaned every weekday. Bed linen and towels are provided and laundered regularly by the house. All bedrooms and common areas are cleaned every weekday. Bed linen and towels are provided and laundered regularly by the house. All bedrooms and common areas are cleaned every weekday. Bed linen and towels are provided and laundered regularly by the house. All bedrooms and common areas are cleaned every weekday. Bed linen and towels are provided and laundered regularly by the house. All bedrooms and common areas are cleaned every weekday. Bed linen and towels are provided and laundered regularly by the house. All bedrooms and common areas are cleaned every weekday. ', '.jpg'),
(4, '2018-05-11', 'Pellentesque fermentum mauris', 'Vivamus accumsan blandit ligula. Sed lobortis efficitur sapien', 'You can help templatemo by telling your friends about our HTML CSS templates. Praesent velit ante, congue ac dignissim in, vehicula sit amet urna. Fusce in dapibus quam, eget finibus velit. Nullam erat odio, vulputate id est ut, consequat rutrum justo. Vivamus vel leo vel nunc tincidunt mattis. Sed neque diam, semper suscipit dictum a, sodales ac metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.\r\n\r\nMorbi vel pharetra massa, non iaculis tortor. Nulla porttitor tincidunt felis et feugiat. Vivamus fermentum ligula justo, sit amet blandit nisl volutpat id. Fusce sagittis ultricies felis, non luctus mauris lacinia quis. Ut fringilla lacus ac tempor ullamcorper. Mauris iaculis placerat ex et mattis.\r\n\r\nQuisque vel sem eu turpis ullamcorper euismod. Praesent quis nisi ac augue luctus viverra. Sed et dui nisi. Fusce vitae dapibus justo. Pellentesque accumsan est ac posuere imperdiet. Curabitur eros mi, lacinia at euismod quis, dapibus vel ligula. Ut sodales erat vitae nunc tempor mollis. Donec tempor lobortis tortor, in feugiat massa facilisis sed. Ut dignissim viverra pretium. In eu justo maximus turpis feugiat finibus scelerisque nec eros. Cras nec lectus tempor nibh vestibulum eleifend et ac elit.\r\n\r\nSed vitae luctus libero. Nam sem neque, finibus id sem pharetra, cursus porttitor ligula. Praesent aliquam fermentum dui, vitae venenatis libero vulputate ac. Fusce bibendum scelerisque magna eget iaculis. Phasellus non arcu eu sem convallis semper. Duis vulputate dignissim rhoncus.', '.jpg'),
(6, '2018-10-25', '<h3 class=\"h3 color--secondary\">Accelerate Your Creative Process</h3>', '<p>Work within a single creative context to maintain your team\'s focus and momentum.</p>', '<div class=\"block__icon__content\">\r\n                                    <p class=\"block__icon__text\"><span style=\"color: rgb(8, 82, 148);\">Crisp, ready-to-use</span> <span style=\"color:#ff7615\">Stencils</span> for all popular use-cases</p>\r\n                                    <ul><li>Drag and drop elements - quickly and easily - from a comprehensive library of widgets and smart-shapes.</li><li>Select from a range of integrated stencil kits for both mobile-app and web design - including iOS, Android, and Bootstrap.</li></ul><p><span style=\"color: rgb(8, 82, 148);\">Built-in library with thousands of popular Icon Sets</span></p><p><span style=\"color: rgb(66, 66, 66);\">Bulk-edit, rename, lock, and group elements. Undo or redo on multiple \r\nlevels. Quickly identify objects, navigate through nested groups, and \r\ntoggle visibility - all within the Outline Panel.</span></p>\r\n                                </div>', '.jpg'),
(7, '2018-10-24', '<h3 class=\"imageCard__title title--large\">Take control of your brand </h3>', '<p>need to design graphics for projects big and small. No design skills necessary: simply drag and drop. </p>', '<p>Bring your brand vision to life: your colors, your fonts, your way. \r\nBuild or add your brand kit and create a consistent look across all of \r\nyour designs with ease. No matter how big your business is, we make it \r\neasy to stay on brand, all the time. </p><p>Need to post your image to Facebook, Twitter and Pinterest? This \r\none-click tool takes the hassle out of cropping and resizing your \r\ndesign. Itâ€™s magic!.</p><h2 class=\"imageCard__title title--large\">\r\nGet your designs moving </h2>\r\n<div class=\"imageCard__content\">\r\n<p>\r\nWith animation, your designs take on a whole new dimension. Whether you \r\nwant to stand out from the crowd on social media or wow your clients \r\nwith a dynamic presentation, animation is the answer. </p>\r\n</div>', '.png'),
(8, '2018-10-21', '<h4>MySQL transaction in PHP <br></h4>', '<p>When you use PDO to <a title=\"PHP MySQL Connect\" href=\"http://www.mysqltutorial.org/php-connecting-to-mysql-database/\">create a connection to the database</a>\r\n that supports the transaction, the auto-commit mode is set. It means \r\nthat every query you issue is wrapped inside an implicit transaction.</p>', '<p>Notice that not all <a title=\"MySQL Storage Engines\" href=\"http://www.mysqltutorial.org/understand-mysql-table-types-innodb-myisam.aspx\">storage engines</a> in MySQL support transaction e.g., MyISAM does not support the transaction, however, InnoDB does.</p><p>To handle MySQL transaction in PHP, you use the following steps:</p><ol><li>Start the transaction by calling the <code>beginTransaction()</code> method of the PDO object.</li><li>Place the SQL statements and theÂ  <code>commit()</code> method call in a <code>try</code> block.</li><li>Rollback the transaction in the <code>catch</code> block by calling the <code>rollBack()</code> method of the PDO object.</li></ol><h2>PHP MySQL transaction example</h2><p>We will <a title=\"MySQLCreate Table\" href=\"http://www.mysqltutorial.org/mysql-create-table/\">create a table</a> named <code>accounts</code> to demonstrate the money transfer between two bank accounts.</p>', '.png'),
(11, '2018-10-21', '<h3>Learn How to avoid form submission on page reload:</h3>', '<p>To avoid this issue we need to follow POST â€“ REDIRECT â€“ GET method along with avoiding browser cache. That means,</p>', '<ul><li>First we need to tell the browser do not cache this page</li><li>After successfully processing POST data, we need to redirect the \r\nuser to same page in the backend. So browser consider this as fresh \r\nrequest and we can add another set of values.</li></ul>\r\n\r\n<p>Below I\'ve given html - php example which implements above method. Save this code in htdocs directory as post.php</p>', '.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', '$2y$10$vv6qhLCa9Rl76UNpjS5/pu141xSvym1APUL7tCIC59wD5gnP.PX0i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
