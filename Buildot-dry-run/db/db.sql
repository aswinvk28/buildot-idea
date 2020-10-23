/*
SQLyog Ultimate v9.62 
MySQL - 5.1.41 : Database - buildot
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/*Table structure for table `abuse_reports` */

DROP TABLE IF EXISTS `abuse_reports`;

CREATE TABLE `abuse_reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(50) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abuse_reports` */

/*Table structure for table `activation` */

DROP TABLE IF EXISTS `activation`;

CREATE TABLE `activation` (
  `activation_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`activation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `activation` */

insert  into `activation`(`activation_id`,`member_id`,`code`,`created`) values (1,69,'13521111160625','2012-11-05 14:24:52');

/*Table structure for table `banner_category` */

DROP TABLE IF EXISTS `banner_category`;

CREATE TABLE `banner_category` (
  `banner_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_category` varchar(255) DEFAULT NULL,
  `width` int(3) DEFAULT NULL,
  `height` int(3) DEFAULT NULL,
  PRIMARY KEY (`banner_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `banner_category` */

insert  into `banner_category`(`banner_cat_id`,`banner_category`,`width`,`height`) values (1,'180x150_a',180,150),(2,'180x150_b',180,150),(3,'180x150_c',180,150),(4,'180x300',180,300),(5,'200x600',200,600),(6,'468x60_a',468,60),(7,'468x60_b',468,60);

/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(255) DEFAULT NULL,
  `banner_cat_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`banner_id`),
  KEY `FK_banners` (`banner_cat_id`),
  CONSTRAINT `FK_banners` FOREIGN KEY (`banner_cat_id`) REFERENCES `banner_category` (`banner_cat_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `banners` */

insert  into `banners`(`banner_id`,`banner_title`,`banner_cat_id`,`file`,`link`,`status`,`created`,`modified`) values (2,'',1,'image13377746680625.png','',1,'2012-05-23 16:04:04',NULL),(3,'',2,'image13377755602969.png','',1,'2012-05-23 16:18:56',NULL),(4,'',3,'image13377755665313.png','',1,'2012-05-23 16:19:02',NULL),(5,'',4,'image13377756075313.png','',1,'2012-05-23 16:19:43',NULL),(6,'',5,'image13377756144063.png','',1,'2012-05-23 16:19:50',NULL),(7,'',6,'image13377756215313.png','',1,'2012-05-23 16:19:57',NULL),(8,'',7,'image13377756278281.png','',1,'2012-05-23 16:20:03',NULL);

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `portfolio` varchar(200) DEFAULT NULL,
  `company_status` int(1) DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `company` */

insert  into `company`(`company_id`,`company_name`,`website`,`logo`,`portfolio`,`company_status`,`created`,`modified`) values (7,'Kunooz Dubai Info Tech LLC','www.kunoozdubai.com','image13358728236563.png','',1,'2012-04-08 13:30:54','2012-11-05 17:22:38');

/*Table structure for table `company_functional_area` */

DROP TABLE IF EXISTS `company_functional_area`;

CREATE TABLE `company_functional_area` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `company_functional_area` */

insert  into `company_functional_area`(`id`,`name`) values (1,'ICT'),(2,'Production'),(3,'Sales'),(4,'Research & Development'),(5,'Administration'),(6,'Customer Service'),(7,'Distribution'),(8,'Finance'),(9,'Human Resources'),(10,'Marketing');

/*Table structure for table `company_project_message` */

DROP TABLE IF EXISTS `company_project_message`;

CREATE TABLE `company_project_message` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `project_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `attachment` varchar(150) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `fr_member` (`member_id`),
  KEY `fr_company_projects` (`project_id`),
  CONSTRAINT `fr_company_projects` FOREIGN KEY (`project_id`) REFERENCES `company_projects` (`project_id`) ON DELETE CASCADE,
  CONSTRAINT `fr_member` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `company_project_message` */

insert  into `company_project_message`(`msg_id`,`message`,`project_id`,`member_id`,`attachment`,`created`) values (28,'hereeeee',1,69,'11-2012/13521189265312.jpg','2012-11-05 16:35:02'),(29,'hiiiiii',1,26,'11-2012/13521191568594.jpg','2012-11-05 16:38:52');

/*Table structure for table `company_project_message_reply` */

DROP TABLE IF EXISTS `company_project_message_reply`;

CREATE TABLE `company_project_message_reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_message` text,
  `msg_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `attachment` varchar(150) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reply_id`),
  KEY `fr_project_message` (`msg_id`),
  KEY `fr_member_table` (`member_id`),
  CONSTRAINT `fr_member_table` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `fr_project_message` FOREIGN KEY (`msg_id`) REFERENCES `company_project_message` (`msg_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `company_project_message_reply` */

insert  into `company_project_message_reply`(`reply_id`,`reply_message`,`msg_id`,`member_id`,`attachment`,`created`) values (21,'hellooooooo',29,69,'11-2012/13521191728125.jpg','2012-11-05 16:39:08');

/*Table structure for table `company_projects` */

DROP TABLE IF EXISTS `company_projects`;

CREATE TABLE `company_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) DEFAULT NULL,
  `project_type` varchar(255) DEFAULT NULL,
  `project_location` varchar(255) DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `project_owner` int(11) DEFAULT NULL,
  `companyId` int(11) DEFAULT NULL,
  `project_description` text,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `fr_countryId` (`countryId`),
  KEY `fr_company` (`companyId`),
  KEY `fr_members` (`project_owner`),
  CONSTRAINT `fr_company` FOREIGN KEY (`companyId`) REFERENCES `company` (`company_id`) ON DELETE CASCADE,
  CONSTRAINT `fr_countryId` FOREIGN KEY (`countryId`) REFERENCES `countries` (`countryId`) ON DELETE CASCADE,
  CONSTRAINT `fr_members` FOREIGN KEY (`project_owner`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `company_projects` */

insert  into `company_projects`(`project_id`,`project_name`,`project_type`,`project_location`,`countryId`,`project_owner`,`companyId`,`project_description`,`created`) values (1,'first project','construction','dubai',182,26,7,'this is our project in dubai','2012-11-05 15:55:21');

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `countryId` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `country_letter` varchar(255) DEFAULT NULL,
  `currency_display` tinyint(1) DEFAULT '0',
  `selected` tinyint(1) DEFAULT '0',
  `display` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`countryId`)
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=latin1;

/*Data for the table `countries` */

insert  into `countries`(`countryId`,`country`,`currency`,`currency_name`,`country_code`,`country_letter`,`currency_display`,`selected`,`display`) values (1,'Afghanistan','AFN','Afghani','93','AF',0,0,1),(2,'Albania','ALL','Lek','355','AL',0,0,1),(3,'Algeria','DZD','Dinar','213','DZ',0,0,1),(4,'Andorra','EUR','Euro','376','AD',0,0,1),(5,'Angola','AOA','Kwanza','244','AO',0,0,1),(6,'Antigua and Barbuda','XCD','Dollar','-267','AG',0,0,1),(7,'Argentina','ARS','Peso','54','AR',0,0,1),(8,'Armenia','AMD','Dram','374','AM',0,0,1),(9,'Australia','AUD','Dollar','61','AU',0,0,1),(10,'Austria','EUR','Euro','43','AT',0,0,1),(11,'Azerbaijan','AZN','Manat','994','AZ',0,0,1),(12,'Bahamas, The','BSD','Dollar','-241','BS',0,0,1),(13,'Bahrain','BHD','Dinar','973','BH',0,0,1),(14,'Bangladesh','BDT','Taka','880','BD',0,0,1),(15,'Barbados','BBD','Dollar','-245','BB',0,0,1),(16,'Belarus','BYR','Ruble','375','BY',0,0,1),(17,'Belgium','EUR','Euro','32','BE',0,0,1),(18,'Belize','BZD','Dollar','501','BZ',0,0,1),(19,'Benin','XOF','Franc','229','BJ',0,0,1),(20,'Bhutan','BTN','Ngultrum','975','BT',0,0,1),(21,'Bolivia','BOB','Boliviano','591','BO',0,0,1),(22,'Bosnia and Herzegovina','BAM','Marka','387','BA',0,0,1),(23,'Botswana','BWP','Pula','267','BW',0,0,1),(24,'Brazil','BRL','Real','55','BR',0,0,1),(25,'Brunei','BND','Dollar','673','BN',0,0,1),(26,'Bulgaria','BGN','Lev','359','BG',0,0,1),(27,'Burkina Faso','XOF','Franc','226','BF',0,0,1),(28,'Burundi','BIF','Franc','257','BI',0,0,1),(29,'Cambodia','KHR','Riels','855','KH',0,0,1),(30,'Cameroon','XAF','Franc','237','CM',0,0,1),(31,'Canada','CAD','Dollar','1','CA',0,0,1),(32,'Cape Verde','CVE','Escudo','238','CV',0,0,1),(33,'Central African Republic','XAF','Franc','236','CF',0,0,1),(34,'Chad','XAF','Franc','235','TD',0,0,1),(35,'Chile','CLP','Peso','56','CL',0,0,1),(36,'China, People\'s Republic of','CNY','Yuan Renminbi','86','CN',0,0,1),(37,'Colombia','COP','Peso','57','CO',0,0,1),(38,'Comoros','KMF','Franc','269','KM',0,0,1),(39,'Congo, (Congo Ã¢â‚¬â€œ Kinshasa)','CDF','Franc','243','CD',0,0,1),(40,'Congo, (Congo Ã¢â‚¬â€œ Brazzaville)','XAF','Franc','242','CG',0,0,1),(41,'Costa Rica','CRC','Colon','506','CR',0,0,1),(42,'Cote d\'Ivoire (Ivory Coast)','XOF','Franc','225','CI',0,0,1),(43,'Croatia','HRK','Kuna','385','HR',0,0,1),(44,'Cuba','CUP','Peso','53','CU',0,0,1),(45,'Cyprus','CYP','Pound','357','CY',0,0,1),(46,'Czech Republic','CZK','Koruna','420','CZ',0,0,1),(47,'Denmark','DKK','Krone','45','DK',0,0,1),(48,'Djibouti','DJF','Franc','253','DJ',0,0,1),(49,'Dominica','XCD','Dollar','-766','DM',0,0,1),(50,'Dominican Republic','DOP','Peso','+1-809','DO',0,0,1),(51,'Ecuador','USD','Dollar','593','EC',0,0,1),(52,'Egypt','EGP','Pound','20','EG',0,0,1),(53,'El Salvador','USD','Dollar','503','SV',0,0,1),(54,'Equatorial Guinea','XAF','Franc','240','GQ',0,0,1),(55,'Eritrea','ERN','Nakfa','291','ER',0,0,1),(56,'Estonia','EEK','Kroon','372','EE',0,0,1),(57,'Ethiopia','ETB','Birr','251','ET',0,0,1),(58,'Fiji','FJD','Dollar','679','FJ',0,0,1),(59,'Finland','EUR','Euro','358','FI',0,0,1),(60,'France','EUR','Euro','33','FR',0,0,1),(61,'Gabon','XAF','Franc','241','GA',0,0,1),(62,'Gambia, The','GMD','Dalasi','220','GM',0,0,1),(63,'Georgia','GEL','Lari','995','GE',0,0,1),(64,'Germany','EUR','Euro','49','DE',0,0,1),(65,'Ghana','GHC','Cedi','233','GH',0,0,1),(66,'Greece','EUR','Euro','30','GR',0,0,1),(67,'Grenada','XCD','Dollar','-472','GD',0,0,1),(68,'Guatemala','GTQ','Quetzal','502','GT',0,0,1),(69,'Guinea','GNF','Franc','224','GN',0,0,1),(70,'Guinea-Bissau','XOF','Franc','245','GW',0,0,1),(71,'Guyana','GYD','Dollar','592','GY',0,0,1),(72,'Haiti','HTG','Gourde','509','HT',0,0,1),(73,'Honduras','HNL','Lempira','504','HN',0,0,1),(74,'Hungary','HUF','Forint','36','HU',0,0,1),(75,'Iceland','ISK','Krona','354','IS',0,0,1),(76,'India','INR','Rupee','91','IN',0,0,1),(77,'Indonesia','IDR','Rupiah','62','ID',0,0,1),(78,'Iran','IRR','Rial','98','IR',0,0,1),(79,'Iraq','IQD','Dinar','964','IQ',0,0,1),(80,'Ireland','EUR','Euro','353','IE',0,0,1),(82,'Italy','EUR','Euro','39','IT',0,0,1),(83,'Jamaica','JMD','Dollar','-875','JM',0,0,1),(84,'Japan','JPY','Yen','81','JP',0,0,1),(85,'Jordan','JOD','Dinar','962','JO',0,0,1),(86,'Kazakhstan','KZT','Tenge','7','KZ',0,0,1),(87,'Kenya','KES','Shilling','254','KE',0,0,1),(88,'Kiribati','AUD','Dollar','686','KI',0,0,1),(89,'Korea, North','KPW','Won','850','KP',0,0,1),(90,'Korea, South','KRW','Won','82','KR',0,0,1),(91,'Kuwait','KWD','Dinar','965','KW',0,0,1),(92,'Kyrgyzstan','KGS','Som','996','KG',0,0,1),(93,'Laos','LAK','Kip','856','LA',0,0,1),(94,'Latvia','LVL','Lat','371','LV',0,0,1),(95,'Lebanon','LBP','Pound','961','LB',0,0,1),(96,'Lesotho','LSL','Loti','266','LS',0,0,1),(97,'Liberia','LRD','Dollar','231','LR',0,0,1),(98,'Libya','LYD','Dinar','218','LY',1,0,1),(99,'Liechtenstein','CHF','Franc','423','LI',0,0,1),(100,'Lithuania','LTL','Litas','370','LT',0,0,1),(101,'Luxembourg','EUR','Euro','352','LU',0,0,1),(102,'Macedonia','MKD','Denar','389','MK',0,0,1),(103,'Madagascar','MGA','Ariary','261','MG',0,0,1),(104,'Malawi','MWK','Kwacha','265','MW',0,0,1),(105,'Malaysia','MYR','Ringgit','60','MY',0,0,1),(106,'Maldives','MVR','Rufiyaa','960','MV',0,0,1),(107,'Mali','XOF','Franc','223','ML',0,0,1),(108,'Malta','MTL','Lira','356','MT',0,0,1),(109,'Marshall Islands','USD','Dollar','692','MH',0,0,1),(110,'Mauritania','MRO','Ouguiya','222','MR',0,0,1),(111,'Mauritius','MUR','Rupee','230','MU',0,0,1),(112,'Mexico','MXN','Peso','52','MX',0,0,1),(113,'Micronesia','USD','Dollar','691','FM',0,0,1),(114,'Moldova','MDL','Leu','373','MD',0,0,1),(115,'Monaco','EUR','Euro','377','MC',0,0,1),(116,'Mongolia','MNT','Tugrik','976','MN',0,0,1),(117,'Montenegro','EUR','Euro','382','ME',0,0,1),(118,'Morocco','MAD','Dirham','212','MA',0,0,1),(119,'Mozambique','MZM','Meticail','258','MZ',0,0,1),(120,'Myanmar (Burma)','MMK','Kyat','95','MM',0,0,1),(121,'Namibia','NAD','Dollar','264','NA',0,0,1),(122,'Nauru','AUD','Dollar','674','NR',0,0,1),(123,'Nepal','NPR','Rupee','977','NP',0,0,1),(124,'Netherlands','EUR','Euro','31','NL',0,0,1),(125,'New Zealand','NZD','Dollar','64','NZ',0,0,1),(126,'Nicaragua','NIO','Cordoba','505','NI',0,0,1),(127,'Niger','XOF','Franc','227','NE',0,0,1),(128,'Nigeria','NGN','Naira','234','NG',0,0,1),(129,'Norway','NOK','Krone','47','NO',0,0,1),(130,'Oman','OMR','Rial','968','OM',0,0,1),(131,'Pakistan','PKR','Rupee','92','PK',0,0,1),(132,'Palau','USD','Dollar','680','PW',0,0,1),(133,'Panama','PAB','Balboa','507','PA',0,0,1),(134,'Papua New Guinea','PGK','Kina','675','PG',0,0,1),(135,'Paraguay','PYG','Guarani','595','PY',0,0,1),(136,'Peru','PEN','Sol','51','PE',0,0,1),(137,'Philippines','PHP','Peso','63','PH',0,0,1),(138,'Poland','PLN','Zloty','48','PL',0,0,1),(139,'Portugal','EUR','Euro','351','PT',0,0,1),(140,'Qatar','QAR','Rial','974','QA',0,0,1),(141,'Romania','RON','Leu','40','RO',0,0,1),(142,'Russia','RUB','Ruble','7','RU',0,0,1),(143,'Rwanda','RWF','Franc','250','RW',0,0,1),(144,'Saint Kitts and Nevis','XCD','Dollar','-868','KN',0,0,1),(145,'Saint Lucia','XCD','Dollar','-757','LC',0,0,1),(146,'Saint Vincent and the Grenadines','XCD','Dollar','-783','VC',0,0,1),(147,'Samoa','WST','Tala','685','WS',0,0,1),(148,'San Marino','EUR','Euro','378','SM',0,0,1),(149,'Sao Tome and Principe','STD','Dobra','239','ST',0,0,1),(150,'Saudi Arabia','SAR','Rial','966','SA',0,0,1),(151,'Senegal','XOF','Franc','221','SN',0,0,1),(152,'Serbia','RSD','Dinar','381','RS',0,0,1),(153,'Seychelles','SCR','Rupee','248','SC',0,0,1),(154,'Sierra Leone','SLL','Leone','232','SL',0,0,1),(155,'Singapore','SGD','Dollar','65','SG',0,0,1),(156,'Slovakia','SKK','Koruna','421','SK',0,0,1),(157,'Slovenia','EUR','Euro','386','SI',0,0,1),(158,'Solomon Islands','SBD','Dollar','677','SB',0,0,1),(159,'Somalia','SOS','Shilling','252','SO',0,0,1),(160,'South Africa','ZAR','Rand','27','ZA',0,0,1),(161,'Spain','EUR','Euro','34','ES',0,0,1),(162,'Sri Lanka','LKR','Rupee','94','LK',0,0,1),(163,'Sudan','SDD','Dinar','249','SD',0,0,1),(164,'Suriname','SRD','Dollar','597','SR',0,0,1),(165,'Swaziland','SZL','Lilangeni','268','SZ',0,0,1),(166,'Sweden','SEK','Kronoa','46','SE',0,0,1),(167,'Switzerland','CHF','Franc','41','CH',0,0,1),(168,'Syria','SYP','Pound','963','SY',0,0,1),(169,'Tajikistan','TJS','Somoni','992','TJ',0,0,1),(170,'Tanzania','TZS','Shilling','255','TZ',0,0,1),(171,'Thailand','THB','Baht','66','TH',0,0,1),(172,'Timor-Leste (East Timor)','USD','Dollar','670','TL',0,0,1),(173,'Togo','XOF','Franc','228','TG',0,0,1),(174,'Tonga','TOP','Pa\'anga','676','TO',0,0,1),(175,'Trinidad and Tobago','TTD','Dollar','-867','TT',0,0,1),(176,'Tunisia','TND','Dinar','216','TN',0,0,1),(177,'Turkey','TRY','Lira','90','TR',0,0,1),(178,'Turkmenistan','TMM','Manat','993','TM',0,0,1),(179,'Tuvalu','AUD','Dollar','688','TV',0,0,1),(180,'Uganda','UGX','Shilling','256','UG',0,0,1),(181,'Ukraine','UAH','Hryvnia','380','UA',0,0,1),(182,'United Arab Emirates','AED','Dirham','971','AE',1,1,1),(183,'United Kingdom','GBP','Pound','44','GB',0,0,1),(184,'United States','USD','Dollar','1','US',0,0,1),(185,'Uruguay','UYU','Peso','598','UY',0,0,1),(186,'Uzbekistan','UZS','Som','998','UZ',0,0,1),(187,'Vanuatu','VUV','Vatu','678','VU',0,0,1),(188,'Vatican City','EUR','Euro','379','VA',0,0,1),(189,'Venezuela','VEB','Bolivar','58','VE',0,0,1),(190,'Vietnam','VND','Dong','84','VN',0,0,1),(191,'Yemen','YER','Rial','967','YE',0,0,1),(192,'Zambia','ZMK','Kwacha','260','ZM',0,0,1),(193,'Zimbabwe','ZWD','Dollar','263','ZW',0,0,1),(194,'Abkhazia','RUB','Ruble','995','GE',0,0,1),(195,'China, Republic of (Taiwan)','TWD','Dollar','886','TW',0,0,1),(196,'Nagorno-Karabakh','AMD','Dram','277','AZ',0,0,1),(197,'Northern Cyprus','TRY','Lira','-302','CY',0,0,1),(198,'Pridnestrovie (Transnistria)','','Ruple','-160','MD',0,0,1),(199,'Somaliland','','Shilling','252','SO',0,0,1),(200,'South Ossetia','RUB and GEL','Ruble and Lari','995','GE',0,0,1),(201,'Ashmore and Cartier Islands','','','','AU',0,0,1),(202,'Christmas Island','AUD','Dollar','61','CX',0,0,1),(203,'Cocos (Keeling) Islands','AUD','Dollar','61','CC',0,0,1),(204,'Coral Sea Islands','','','','AU',0,0,1),(205,'Heard Island and McDonald Islands','','','','HM',0,0,1),(206,'Norfolk Island','AUD','Dollar','672','NF',0,0,1),(207,'New Caledonia','XPF','Franc','687','NC',0,0,1),(208,'French Polynesia','XPF','Franc','689','PF',0,0,1),(209,'Mayotte','EUR','Euro','262','YT',0,0,1),(210,'Saint Barthelemy','EUR','Euro','590','GP',0,0,1),(211,'Saint Martin','EUR','Euro','590','GP',0,0,1),(212,'Saint Pierre and Miquelon','EUR','Euro','508','PM',0,0,1),(213,'Wallis and Futuna','XPF','Franc','681','WF',0,0,1),(214,'French Southern and Antarctic Lands','','','','TF',0,0,1),(215,'Clipperton Island','','','','PF',0,0,1),(216,'Bouvet Island','','','','BV',0,0,1),(217,'Cook Islands','NZD','Dollar','682','CK',0,0,1),(218,'Niue','NZD','Dollar','683','NU',0,0,1),(219,'Tokelau','NZD','Dollar','690','TK',0,0,1),(220,'Guernsey','GGP','Pound','44','GG',0,0,1),(221,'Isle of Man','IMP','Pound','44','IM',0,0,1),(222,'Jersey','JEP','Pound','44','JE',0,0,1),(223,'Anguilla','XCD','Dollar','-263','AI',0,0,1),(224,'Bermuda','BMD','Dollar','-440','BM',0,0,1),(225,'British Indian Ocean Territory','','','246','IO',0,0,1),(226,'British Sovereign Base Areas','CYP','Pound','357','',0,0,1),(227,'British Virgin Islands','USD','Dollar','-283','VG',0,0,1),(228,'Cayman Islands','KYD','Dollar','-344','KY',0,0,1),(229,'Falkland Islands (Islas Malvinas)','FKP','Pound','500','FK',0,0,1),(230,'Gibraltar','GIP','Pound','350','GI',0,0,1),(231,'Montserrat','XCD','Dollar','-663','MS',0,0,1),(232,'Pitcairn Islands','NZD','Dollar','','PN',0,0,1),(233,'Saint Helena','SHP','Pound','290','SH',0,0,1),(234,'South Georgia','','','','GS',0,0,1),(235,'Turks and Caicos Islands','USD','Dollar','-648','TC',0,0,1),(236,'Northern Mariana Islands','USD','Dollar','-669','MP',0,0,1),(237,'Puerto Rico','USD','Dollar','+1-787','PR',0,0,1),(238,'American Samoa','USD','Dollar','-683','AS',0,0,1),(239,'Baker Island','','','','UM',0,0,1),(240,'Guam','USD','Dollar','-670','GU',0,0,1),(241,'Howland Island','','','','UM',0,0,1),(242,'Jarvis Island','','','','UM',0,0,1),(243,'Johnston Atoll','','','','UM',0,0,1),(244,'Kingman Reef','','','','UM',0,0,1),(245,'Midway Islands','','','','UM',0,0,1),(246,'Navassa Island','','','','UM',0,0,1),(247,'Palmyra Atoll','','','','UM',0,0,1),(248,'U.S. Virgin Islands','USD','Dollar','-339','VI',0,0,1),(249,'Wake Island','','','','UM',0,0,1),(250,'Hong Kong','HKD','Dollar','852','HK',0,0,1),(251,'Macau','MOP','Pataca','853','MO',0,0,1),(252,'Faroe Islands','DKK','Krone','298','FO',0,0,1),(253,'Greenland','DKK','Krone','299','GL',0,0,1),(254,'French Guiana','EUR','Euro','594','GF',0,0,1),(255,'Guadeloupe','EUR','Euro','590','GP',0,0,1),(256,'Martinique','EUR','Euro','596','MQ',0,0,1),(257,'Reunion','EUR','Euro','262','RE',0,0,1),(258,'Aland','EUR','Euro','340','AX',0,0,1),(259,'Aruba','AWG','Guilder','297','AW',0,0,1),(260,'Netherlands Antilles','ANG','Guilder','599','AN',0,0,1),(261,'Svalbard','NOK','Krone','47','SJ',0,0,1),(262,'Ascension','SHP','Pound','247','AC',0,0,1),(263,'Tristan da Cunha','SHP','Pound','290','TA',0,0,1),(264,'Australian Antarctic Territory','','','','AQ',0,0,1),(265,'Ross Dependency','','','','AQ',0,0,1),(266,'Peter I Island','','','','AQ',0,0,1),(267,'Queen Maud Land','','','','AQ',0,0,1),(268,'British Antarctic Territory','','','','AQ',0,0,1);

/*Table structure for table `event_message` */

DROP TABLE IF EXISTS `event_message`;

CREATE TABLE `event_message` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `event_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `FK_event_message` (`event_id`),
  KEY `FK_event_message_1` (`member_id`),
  CONSTRAINT `FK_event_message` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_event_message_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `event_message` */

insert  into `event_message`(`msg_id`,`message`,`event_id`,`member_id`,`created`) values (18,'everyone please be on time',1,69,'2012-11-05 16:29:47'),(19,'dfsgdfsgsdfgs',1,26,'2012-11-05 16:31:52');

/*Table structure for table `event_message_reply` */

DROP TABLE IF EXISTS `event_message_reply`;

CREATE TABLE `event_message_reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_message` text,
  `msg_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reply_id`),
  KEY `FK_event_message_reply` (`msg_id`),
  KEY `FK_event_message_reply_1` (`member_id`),
  CONSTRAINT `FK_event_message_reply` FOREIGN KEY (`msg_id`) REFERENCES `event_message` (`msg_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_event_message_reply_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `event_message_reply` */

insert  into `event_message_reply`(`reply_id`,`reply_message`,`msg_id`,`member_id`,`created`) values (32,'replyyyyy',18,26,'2012-11-05 16:30:20'),(33,'okkkkk',18,26,'2012-11-05 16:30:25'),(34,'sureeeeeeeee',18,26,'2012-11-05 16:30:32');

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(150) DEFAULT NULL,
  `description` text,
  `location` varchar(255) DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `FK_events` (`created_by`),
  KEY `FK_events_countries` (`countryId`),
  CONSTRAINT `FK_events` FOREIGN KEY (`created_by`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_events_countries` FOREIGN KEY (`countryId`) REFERENCES `countries` (`countryId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `events` */

insert  into `events`(`event_id`,`event_title`,`description`,`location`,`countryId`,`event_date`,`created_by`,`website`,`image`,`created`) values (1,'friday event','friends gettogether','dubai',182,'2012-11-09 16:00:00',69,'www.kunoozdubai.com','11-2012/13521185939375.jpg','2012-11-05 16:29:29');

/*Table structure for table `forget_password` */

DROP TABLE IF EXISTS `forget_password`;

CREATE TABLE `forget_password` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `forget_password` */

/*Table structure for table `friend_requests` */

DROP TABLE IF EXISTS `friend_requests`;

CREATE TABLE `friend_requests` (
  `friend_request_id` int(10) NOT NULL AUTO_INCREMENT,
  `from_member_id` int(15) DEFAULT NULL,
  `to_member_id` int(15) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`friend_request_id`),
  KEY `FK_friend_requests` (`from_member_id`),
  KEY `FK_friend_requests_1` (`to_member_id`),
  CONSTRAINT `FK_friend_requests` FOREIGN KEY (`from_member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_friend_requests_1` FOREIGN KEY (`to_member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*Data for the table `friend_requests` */

insert  into `friend_requests`(`friend_request_id`,`from_member_id`,`to_member_id`,`status`,`created`) values (66,69,26,'request accepted','2012-11-05 14:27:46');

/*Table structure for table `group_members` */

DROP TABLE IF EXISTS `group_members`;

CREATE TABLE `group_members` (
  `member_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`member_group_id`),
  KEY `FK_group_members` (`group_id`),
  KEY `FK_group_members_1` (`member_id`),
  CONSTRAINT `FK_group_members` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_group_members_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

/*Data for the table `group_members` */

insert  into `group_members`(`member_group_id`,`group_id`,`member_id`,`created`) values (83,1,69,NULL),(85,1,26,NULL);

/*Table structure for table `group_message` */

DROP TABLE IF EXISTS `group_message`;

CREATE TABLE `group_message` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `group_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `FK_group_message` (`group_id`),
  KEY `FK_group_message_1` (`member_id`),
  CONSTRAINT `FK_group_message` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_group_message_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `group_message` */

insert  into `group_message`(`msg_id`,`message`,`group_id`,`member_id`,`created`) values (23,'this is the my first post',1,26,'2012-11-05 16:20:33');

/*Table structure for table `group_message_reply` */

DROP TABLE IF EXISTS `group_message_reply`;

CREATE TABLE `group_message_reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_message` text,
  `msg_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reply_id`),
  KEY `FK_group_message_reply` (`member_id`),
  KEY `FK_group_message_reply_1` (`msg_id`),
  CONSTRAINT `FK_group_message_reply` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_group_message_reply_1` FOREIGN KEY (`msg_id`) REFERENCES `group_message` (`msg_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `group_message_reply` */

insert  into `group_message_reply`(`reply_id`,`reply_message`,`msg_id`,`member_id`,`created`) values (34,'mine is the first reply',23,69,'2012-11-05 16:20:51'),(35,'second........',23,69,'2012-11-05 16:21:06'),(36,'third',23,69,'2012-11-05 16:21:10');

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `group_id` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  `group_type` varchar(100) DEFAULT NULL,
  `group_owner` int(11) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `privacy` varchar(25) DEFAULT NULL,
  `summary` text,
  `description` text,
  `group_image` varchar(150) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `FK_groups` (`group_owner`),
  CONSTRAINT `FK_groups` FOREIGN KEY (`group_owner`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `groups` */

insert  into `groups`(`group_id`,`group_name`,`group_type`,`group_owner`,`website`,`privacy`,`summary`,`description`,`group_image`,`created`) values (1,'LBSCE','friends',69,'www.kunoozdubai.com','Open','this group is for the LBS students','this group is for the LBS students','image13521180317969.jpg','2012-11-05 16:20:08');

/*Table structure for table `hide_updates` */

DROP TABLE IF EXISTS `hide_updates`;

CREATE TABLE `hide_updates` (
  `hide_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `update_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`hide_id`),
  KEY `member_id` (`member_id`),
  KEY `update_id` (`update_id`),
  CONSTRAINT `hide_updates_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `hide_updates_ibfk_2` FOREIGN KEY (`update_id`) REFERENCES `updates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `hide_updates` */

insert  into `hide_updates`(`hide_id`,`member_id`,`update_id`,`created`) values (1,26,53,'2012-11-05 16:56:43');

/*Table structure for table `job_categories` */

DROP TABLE IF EXISTS `job_categories`;

CREATE TABLE `job_categories` (
  `job_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_cat_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`job_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `job_categories` */

insert  into `job_categories`(`job_cat_id`,`job_cat_name`) values (1,'Administration Jobs'),(2,'Art/Design/Creative Jobs'),(3,'Customer Service Jobs'),(4,'Education/Training Jobs'),(5,'Engineering Jobs'),(6,'Healthcare/Medical Jobs'),(7,'Human Resources/Personnel Jobs'),(8,'IT Jobs'),(9,'Banking & Finance'),(10,'Managerial & Supervisory'),(11,'Skilled Labour'),(12,'Unskilled Labour');

/*Table structure for table `job_openings` */

DROP TABLE IF EXISTS `job_openings`;

CREATE TABLE `job_openings` (
  `job_opening_id` int(15) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `location` varchar(255) DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `job_cat_id` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`job_opening_id`),
  KEY `FK_job_openings` (`job_cat_id`),
  KEY `FK_job_openings_1` (`created_by`),
  CONSTRAINT `FK_job_openings` FOREIGN KEY (`job_cat_id`) REFERENCES `job_categories` (`job_cat_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_job_openings_1` FOREIGN KEY (`created_by`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `job_openings` */

insert  into `job_openings`(`job_opening_id`,`title`,`description`,`location`,`contact_number`,`email`,`job_cat_id`,`expiry_date`,`status`,`created_by`,`created`,`modified`) values (1,'java programmer','this vacancy is for administrative jobs','dubai','042808462','info@kunoozdubai.com',1,'2012-11-30',1,26,'2012-11-05 15:53:47',NULL);

/*Table structure for table `members` */

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `member_id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `company_type` varchar(255) DEFAULT NULL,
  `company_functional_area_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `designation` varchar(150) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `member_photo` varchar(150) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `cv` varchar(200) DEFAULT NULL,
  `portfolio` varchar(200) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`member_id`),
  KEY `FK_members` (`user_id`),
  KEY `FK_members_company` (`company_id`),
  KEY `FK_members_functional_area` (`company_functional_area_id`),
  KEY `FK_members_countries` (`countryId`),
  CONSTRAINT `FK_members` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_members_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_members_countries` FOREIGN KEY (`countryId`) REFERENCES `countries` (`countryId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

/*Data for the table `members` */

insert  into `members`(`member_id`,`user_id`,`company_id`,`company_type`,`company_functional_area_id`,`first_name`,`last_name`,`designation`,`telephone`,`mobile`,`fax`,`location`,`countryId`,`gender`,`dateOfBirth`,`member_photo`,`status`,`cv`,`portfolio`,`created`,`modified`) values (26,34,7,'interiors',5,'Karram Altaf','Muhammed Hussain','IT Manager','042808462','0554665716','042808469','Dubai',182,NULL,NULL,'image13484778435625.png',1,NULL,NULL,'2012-04-09 17:15:37','2012-10-10 11:18:11'),(69,89,NULL,NULL,NULL,'haseena','shameel',NULL,NULL,'',NULL,'dubai',182,'Female','1985-04-01',NULL,1,NULL,NULL,'2012-11-05 14:24:52','2012-11-05 16:18:46');

/*Table structure for table `post_reply` */

DROP TABLE IF EXISTS `post_reply`;

CREATE TABLE `post_reply` (
  `post_reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(500) DEFAULT NULL,
  `send_by` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_reply_id`),
  KEY `FK_post_reply` (`post_id`),
  KEY `FK_post_reply_1` (`send_by`),
  CONSTRAINT `FK_post_reply` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_post_reply_1` FOREIGN KEY (`send_by`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `post_reply` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(500) DEFAULT NULL,
  `send_by` int(11) DEFAULT NULL,
  `attachment` varchar(150) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `FK_posts` (`send_by`),
  CONSTRAINT `FK_posts` FOREIGN KEY (`send_by`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `posts` */

/*Table structure for table `project_invites` */

DROP TABLE IF EXISTS `project_invites`;

CREATE TABLE `project_invites` (
  `project_invite_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `from_member_id` int(11) DEFAULT NULL,
  `to_member_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`project_invite_id`),
  KEY `project_id` (`project_id`),
  KEY `from_member_id` (`from_member_id`),
  KEY `to_member_id` (`to_member_id`),
  CONSTRAINT `project_invites_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `company_projects` (`project_id`) ON DELETE CASCADE,
  CONSTRAINT `project_invites_ibfk_2` FOREIGN KEY (`from_member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `project_invites_ibfk_3` FOREIGN KEY (`to_member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `project_invites` */

insert  into `project_invites`(`project_invite_id`,`project_id`,`from_member_id`,`to_member_id`,`status`,`created`) values (19,1,26,69,'request accepted','2012-11-05 15:55:37');

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_ref_no` varchar(15) DEFAULT NULL,
  `project_name` varchar(150) DEFAULT NULL,
  `project_location` varchar(150) DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `location_map` varchar(150) DEFAULT NULL,
  `max_alloc_budget` int(10) DEFAULT NULL,
  `opening_date` date DEFAULT NULL,
  `closing_date` date DEFAULT NULL,
  `description` text,
  `attachment1` varchar(150) DEFAULT NULL,
  `attachment2` varchar(150) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `publishto` int(1) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `FK_projects` (`member_id`),
  KEY `FK_projects_countries` (`countryId`),
  CONSTRAINT `FK_projects` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_projects_countries` FOREIGN KEY (`countryId`) REFERENCES `countries` (`countryId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `projects` */

insert  into `projects`(`project_id`,`project_ref_no`,`project_name`,`project_location`,`countryId`,`location_map`,`max_alloc_budget`,`opening_date`,`closing_date`,`description`,`attachment1`,`attachment2`,`member_id`,`publishto`,`created`,`modified`) values (1,'fftt11','first tender','dubai',182,'image13521160750938.jpg',NULL,'2012-11-05','2012-11-27','this is the first project of our company calling for tenders.','11-2012/13521160752612.jpg',NULL,26,1,'2012-11-05 15:47:31',NULL),(2,'hh111','building school','dubai',182,'image13521161480938.jpg',NULL,'2012-11-05','2012-11-21','this is our new project calling for tenders','11-2012/13521161482394.jpg',NULL,69,1,'2012-11-05 15:48:44',NULL);

/*Table structure for table `read_projects` */

DROP TABLE IF EXISTS `read_projects`;

CREATE TABLE `read_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `read_projects_ibfk_1` (`member_id`),
  KEY `read_projects_ibfk_2` (`project_id`),
  CONSTRAINT `read_projects_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `read_projects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `read_projects` */

insert  into `read_projects`(`id`,`member_id`,`project_id`) values (9,26,2),(10,69,1);

/*Table structure for table `read_tenders` */

DROP TABLE IF EXISTS `read_tenders`;

CREATE TABLE `read_tenders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `tender_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `read_tenders_ibfk_1` (`member_id`),
  KEY `read_tenders_ibfk_2` (`tender_id`),
  CONSTRAINT `read_tenders_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `read_tenders_ibfk_2` FOREIGN KEY (`tender_id`) REFERENCES `tenders` (`tender_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `read_tenders` */

insert  into `read_tenders`(`id`,`member_id`,`tender_id`) values (3,69,33),(4,26,34);

/*Table structure for table `share_invites` */

DROP TABLE IF EXISTS `share_invites`;

CREATE TABLE `share_invites` (
  `share_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_member_id` int(11) DEFAULT NULL,
  `to_member_id` int(11) DEFAULT NULL,
  `page` varchar(100) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`share_id`),
  KEY `FK_share_invites` (`from_member_id`),
  KEY `FK_share_invites_1` (`to_member_id`),
  CONSTRAINT `FK_share_invites` FOREIGN KEY (`from_member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_share_invites_1` FOREIGN KEY (`to_member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `share_invites` */

insert  into `share_invites`(`share_id`,`from_member_id`,`to_member_id`,`page`,`id`,`status`,`created`) values (1,69,26,'tenderDetails',1,'invited','2012-11-06 15:17:11');

/*Table structure for table `tender_comments` */

DROP TABLE IF EXISTS `tender_comments`;

CREATE TABLE `tender_comments` (
  `tender_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `tender_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tender_comment_id`),
  KEY `FK_tender_comments` (`tender_id`),
  KEY `FK_tender_comments_1` (`member_id`),
  CONSTRAINT `FK_tender_comments` FOREIGN KEY (`tender_id`) REFERENCES `tenders` (`tender_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_tender_comments_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

/*Data for the table `tender_comments` */

insert  into `tender_comments`(`tender_comment_id`,`tender_id`,`comment`,`member_id`,`created`) values (68,33,'fgdhghgfh',26,'2012-11-05 15:50:19'),(69,33,'fghfghdg',69,'2012-11-05 15:50:28');

/*Table structure for table `tenders` */

DROP TABLE IF EXISTS `tenders`;

CREATE TABLE `tenders` (
  `tender_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `proposed_budget` int(10) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `attachment` varchar(150) DEFAULT NULL,
  `count` int(10) DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tender_id`),
  KEY `FK_tenders` (`project_id`),
  KEY `FK_tenders_members` (`member_id`),
  CONSTRAINT `FK_tenders` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_tenders_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `tenders` */

insert  into `tenders`(`tender_id`,`project_id`,`title`,`description`,`proposed_budget`,`member_id`,`sector`,`attachment`,`count`,`created`) values (33,2,NULL,'this is my quote.',15000,26,'interiors','11-2012/13521161872656.jpg',1,'2012-11-05 15:49:23'),(34,1,NULL,'fghgdh',2562,69,'dghgfh',NULL,1,'2012-11-06 14:27:34');

/*Table structure for table `update_reply` */

DROP TABLE IF EXISTS `update_reply`;

CREATE TABLE `update_reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) DEFAULT NULL,
  `send_by` int(11) DEFAULT NULL,
  `update_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reply_id`),
  KEY `FK_update_reply` (`update_id`),
  KEY `FK_update_reply_1` (`send_by`),
  CONSTRAINT `FK_update_reply` FOREIGN KEY (`update_id`) REFERENCES `updates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_update_reply_1` FOREIGN KEY (`send_by`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=latin1;

/*Data for the table `update_reply` */

insert  into `update_reply`(`reply_id`,`message`,`send_by`,`update_id`,`created`) values (239,'hellooooo',69,1,'2012-11-05 14:36:56'),(240,'how r u?????',69,1,'2012-11-05 14:37:47'),(241,'hiiiiiiiii',69,1,'2012-11-05 14:38:07'),(242,'nnn',26,4,'2012-11-05 15:06:55'),(243,'ww',26,4,'2012-11-05 15:10:15'),(244,'sdsd',26,4,'2012-11-05 15:11:15'),(245,'adfdf',26,5,'2012-11-05 15:11:19'),(246,'111111111111111',26,6,'2012-11-05 15:11:29'),(247,'wewe',26,6,'2012-11-05 15:12:56'),(248,'44444444',26,6,'2012-11-05 15:13:06'),(249,'22222222222',26,7,'2012-11-05 15:17:16'),(250,'ssd',26,9,'2012-11-05 15:18:45'),(251,'aaaaaaaa3333333333',26,10,'2012-11-05 15:18:52'),(252,'jkjkjkjkjkjkjkjkjkjkjkjkjkjk',26,7,'2012-11-05 15:19:17'),(253,'hhhhhhhh',26,8,'2012-11-05 15:19:20'),(254,'mkokmioko',26,7,'2012-11-05 15:19:43'),(255,'ghfjghjg',26,17,'2012-11-05 15:45:16'),(256,'ghjghjhf',26,18,'2012-11-05 15:45:20'),(257,'jhgjhgj',26,17,'2012-11-05 15:45:31'),(258,'replyyyyyyyyyy',26,17,'2012-11-05 15:45:40'),(259,'rrrrrrrrrrrrrr',26,17,'2012-11-05 15:45:47'),(260,'gfhfgh',69,20,'2012-11-05 15:46:03'),(261,'fgdhg',26,23,'2012-11-05 15:46:24'),(262,'hjkjkbk',26,36,'2012-11-05 16:14:40');

/*Table structure for table `updates` */

DROP TABLE IF EXISTS `updates`;

CREATE TABLE `updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_message` varchar(255) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `ids` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_updates` (`member_id`),
  CONSTRAINT `FK_updates` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

/*Data for the table `updates` */

insert  into `updates`(`id`,`update_message`,`member_id`,`table_name`,`ids`,`created`) values (1,'is now connected to',26,'friend_requests',66,'2012-11-05 14:28:17'),(2,'has replied on the update for:',69,'update_reply',239,'2012-11-05 14:36:56'),(3,'has replied on the update for:',69,'update_reply',240,'2012-11-05 14:37:47'),(4,'has replied on the update for:',69,'update_reply',241,'2012-11-05 14:38:07'),(5,'has replied on the update for:',26,'update_reply',242,'2012-11-05 15:06:55'),(6,'has replied on the update for:',26,'update_reply',243,'2012-11-05 15:10:15'),(7,'has replied on the update for:',26,'update_reply',244,'2012-11-05 15:11:15'),(8,'has replied on the update for:',26,'update_reply',245,'2012-11-05 15:11:19'),(9,'has replied on the update for:',26,'update_reply',246,'2012-11-05 15:11:29'),(10,'has replied on the update for:',26,'update_reply',247,'2012-11-05 15:12:57'),(11,'has replied on the update for:',26,'update_reply',248,'2012-11-05 15:13:06'),(12,'has replied on the update for:',26,'update_reply',249,'2012-11-05 15:17:16'),(13,'has replied on the update for:',26,'update_reply',250,'2012-11-05 15:18:45'),(14,'has replied on the update for:',26,'update_reply',251,'2012-11-05 15:18:52'),(15,'has replied on the update for:',26,'update_reply',252,'2012-11-05 15:19:17'),(16,'has replied on the update for:',26,'update_reply',253,'2012-11-05 15:19:20'),(17,'has replied on the update for:',26,'update_reply',254,'2012-11-05 15:19:43'),(18,'has replied on the update for:',26,'update_reply',255,'2012-11-05 15:45:16'),(19,'has replied on the update for:',26,'update_reply',256,'2012-11-05 15:45:20'),(20,'has replied on the update for:',26,'update_reply',257,'2012-11-05 15:45:31'),(21,'has replied on the update for:',26,'update_reply',258,'2012-11-05 15:45:40'),(22,'has replied on the update for:',26,'update_reply',259,'2012-11-05 15:45:47'),(23,'has replied on the update for:',69,'update_reply',260,'2012-11-05 15:46:04'),(24,'has replied on the update for:',26,'update_reply',261,'2012-11-05 15:46:25'),(25,'invited a tender:',26,'projects',1,'2012-11-05 15:47:31'),(26,'invited a tender:',69,'projects',2,'2012-11-05 15:48:44'),(27,'tender quote has been sent for:',26,'tenders',33,'2012-11-05 15:49:23'),(28,'has commented on:',26,'tender_comments',68,'2012-11-05 15:50:19'),(29,'has commented on:',69,'tender_comments',69,'2012-11-05 15:50:28'),(30,'posted a job you may be interested in:',26,'job_openings',1,'2012-11-05 15:53:47'),(31,'is interested in',69,'job_application',1,'2012-11-05 15:54:26'),(32,'added the project:',26,'company_projects',1,'2012-11-05 15:55:21'),(33,'has invited',26,'project_requests',19,'2012-11-05 15:55:37'),(34,'is interested in',69,'job_application',1,'2012-11-05 15:55:54'),(35,'is now viewing',69,'project_invites',19,'2012-11-05 16:06:29'),(36,'is now connected to',26,'friend_requests',66,'2012-11-05 16:06:35'),(37,'has replied on the update for:',26,'update_reply',262,'2012-11-05 16:14:40'),(38,'has updated the profile',69,'profile',NULL,'2012-11-05 16:18:24'),(39,'has updated the profile',69,'profile',NULL,'2012-11-05 16:18:46'),(40,'added the group:',69,'groups',1,'2012-11-05 16:20:08'),(41,'has commented on:',26,'group_message',23,'2012-11-05 16:20:33'),(42,'has replied on the update for:',69,'group_message_reply',34,'2012-11-05 16:20:51'),(43,'has replied on the update for:',69,'group_message_reply',35,'2012-11-05 16:21:06'),(44,'has replied on the update for:',69,'group_message_reply',36,'2012-11-05 16:21:10'),(45,'added the event:',69,'events',1,'2012-11-05 16:29:29'),(46,'has commented on:',69,'event_message',18,'2012-11-05 16:29:47'),(47,'has replied on the update for:',26,'event_message_reply',32,'2012-11-05 16:30:20'),(48,'has replied on the update for:',26,'event_message_reply',33,'2012-11-05 16:30:25'),(49,'has replied on the update for:',26,'event_message_reply',34,'2012-11-05 16:30:32'),(50,'has commented on:',26,'event_message',19,'2012-11-05 16:31:52'),(51,'has commented on:',69,'company_project_message',28,'2012-11-05 16:35:02'),(52,'has commented on:',26,'company_project_message',29,'2012-11-05 16:38:52'),(53,'has replied on the update for:',69,'company_project_message_reply',21,'2012-11-05 16:39:08'),(54,'tender quote has been sent for:',69,'tenders',34,'2012-11-06 14:27:34'),(55,'has shared with',69,'share_invites',1,'2012-11-06 15:17:11');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `usertype` int(11) DEFAULT '1',
  `status` int(1) DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_users` (`usertype`),
  CONSTRAINT `FK_users` FOREIGN KEY (`usertype`) REFERENCES `usertype` (`usertype`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`email`,`password`,`usertype`,`status`,`created`,`modified`) values (1,'admin','5f4dcc3b5aa765d61d8327deb882cf99',2,1,'2012-03-24 11:13:30','2012-11-05 17:23:25'),(34,'support@kunoozdubai.com','5f4dcc3b5aa765d61d8327deb882cf99',1,1,'2012-04-02 13:21:37','0000-00-00 00:00:00'),(89,'haseenash@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99',1,1,'2012-11-05 14:24:52',NULL);

/*Table structure for table `usertype` */

DROP TABLE IF EXISTS `usertype`;

CREATE TABLE `usertype` (
  `usertype` int(11) NOT NULL AUTO_INCREMENT,
  `usertypename` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`usertype`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usertype` */

insert  into `usertype`(`usertype`,`usertypename`) values (1,'Member'),(2,'Admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
