-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 01, 2016 at 04:05 PM
-- Server version: 5.1.54
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rh_main`
--

-- --------------------------------------------------------
--
-- Table structure for table `rhr_adminaccess_groups`
--

CREATE TABLE `rhr_adminaccess_groups` (
  `internal_id` smallint(6) NOT NULL DEFAULT '0',
  `adminkey` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_adminkeys`
--

CREATE TABLE `rhr_adminkeys` (
  `internal_id` int(11) NOT NULL,
  `adminkey` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `keylevel` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `keyvalid` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_adqueue`
--

CREATE TABLE `rhr_adqueue` (
  `id` int(11) NOT NULL,
  `group` tinyint(4) NOT NULL DEFAULT '0',
  `description` varchar(48) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `width` smallint(6) NOT NULL DEFAULT '0',
  `height` smallint(6) NOT NULL DEFAULT '0',
  `code` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_albumresolver`
--

CREATE TABLE `rhr_albumresolver` (
  `internal_id` int(11) NOT NULL,
  `external_album_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_albumtype_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '9o58ENkz5o0r5v1L',
  `album_name_sortable` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `album_name_display` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `default_external_release_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_albums`
--

CREATE TABLE `rhr_albums` (
  `internal_id` int(11) NOT NULL,
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_album_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_country_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_label_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ReleaseTitle` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `mediaType` text CHARACTER SET latin1,
  `country` text CHARACTER SET latin1 NOT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `ReleaseType` text CHARACTER SET latin1,
  `ReleaseCatNumber` text CHARACTER SET latin1,
  `ReleaseArtist` text CHARACTER SET latin1,
  `releaseLabel` text CHARACTER SET latin1,
  `imgUrlSmall` text CHARACTER SET latin1,
  `imgUrlMed` text CHARACTER SET latin1,
  `imgUrlLg` text CHARACTER SET latin1,
  `amazonLink` text CHARACTER SET latin1,
  `notes` text CHARACTER SET latin1,
  `release_year` int(4) NOT NULL DEFAULT '0',
  `external_release_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_albumtyperesolver`
--

CREATE TABLE `rhr_albumtyperesolver` (
  `internal_id` smallint(6) NOT NULL,
  `external_albumtype_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `albumtype_name_display` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_alternatetitles`
--

CREATE TABLE `rhr_alternatetitles` (
  `internal_id` smallint(6) NOT NULL,
  `internal_song_id` smallint(6) NOT NULL DEFAULT '0',
  `external_song_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alternatetitle` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_alternatevenuenames`
--

CREATE TABLE `rhr_alternatevenuenames` (
  `internal_id` smallint(6) NOT NULL,
  `primary_external_venue_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alt_external_venue_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_city_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `venue_name_display` text COLLATE utf8_unicode_ci NOT NULL,
  `venue_name_sortable` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_altlivetracks`
--

CREATE TABLE `rhr_altlivetracks` (
  `internal_id` int(11) NOT NULL,
  `external_show_id` varchar(16) NOT NULL,
  `external_setlist_id` varchar(16) NOT NULL,
  `encore_level` tinyint(4) NOT NULL,
  `songComments` text,
  `songNumber` smallint(6) DEFAULT NULL,
  `external_song_id` varchar(16) NOT NULL,
  `external_songversion_id` varchar(16) NOT NULL,
  `nonstandard_track` tinyint(4) NOT NULL,
  `modified_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `setlist_author_id` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_annotations`
--

CREATE TABLE `rhr_annotations` (
  `internal_id` int(11) NOT NULL,
  `external_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `annotation_text` text COLLATE utf8_unicode_ci NOT NULL,
  `annotation_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `annotation_author` varchar(24) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_artistresolver`
--

CREATE TABLE `rhr_artistresolver` (
  `internal_id` bigint(20) NOT NULL,
  `external_artist_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `artist_name_display` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `artist_name_sortable` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `external_hometown_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000000',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_artistresolver_old`
--

CREATE TABLE `rhr_artistresolver_old` (
  `internal_id` int(11) NOT NULL,
  `external_artist_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `artist_name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `artist_name_sortable` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_artistroles`
--

CREATE TABLE `rhr_artistroles` (
  `internal_id` int(11) NOT NULL,
  `external_artist_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_role_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_artistthumbnails`
--

CREATE TABLE `rhr_artistthumbnails` (
  `internal_id` mediumint(9) NOT NULL,
  `external_artist_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_image_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_bandgroupings`
--

CREATE TABLE `rhr_bandgroupings` (
  `internal_id` bigint(20) NOT NULL,
  `external_artist_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `rel_start` date NOT NULL DEFAULT '0000-00-00',
  `rel_end` date NOT NULL DEFAULT '0000-00-00',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_bandgroupings_former`
--

CREATE TABLE `rhr_bandgroupings_former` (
  `internal_id` bigint(20) NOT NULL,
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_artist_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `member_start_year` smallint(4) NOT NULL DEFAULT '0',
  `member_end_year` smallint(4) NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_bio`
--

CREATE TABLE `rhr_bio` (
  `internal_id` int(11) NOT NULL,
  `external_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `bio_text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_cityresolver`
--

CREATE TABLE `rhr_cityresolver` (
  `internal_id` int(4) NOT NULL,
  `external_city_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city_name_display` text COLLATE utf8_unicode_ci NOT NULL,
  `city_name_sortable` text COLLATE utf8_unicode_ci NOT NULL,
  `cityname` text COLLATE utf8_unicode_ci NOT NULL,
  `city_lat` decimal(14,10) DEFAULT NULL,
  `city_lng` decimal(14,10) DEFAULT NULL,
  `geo_area_level` int(11) DEFAULT NULL,
  `gmapzoom` tinyint(4) NOT NULL DEFAULT '7',
  `internal_locale_id` int(4) NOT NULL DEFAULT '0',
  `external_locale_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modified_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_comments`
--

CREATE TABLE `rhr_comments` (
  `internal_id` int(11) NOT NULL,
  `legacy_comment_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_comment_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_commenttopic_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `comment_text` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_author` text COLLATE utf8_unicode_ci NOT NULL,
  `commentShowID` int(11) NOT NULL DEFAULT '0',
  `comment_submit_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_active` tinyint(4) NOT NULL DEFAULT '0',
  `comment_author_email` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_author_ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_errata` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_comments_new`
--

CREATE TABLE `rhr_comments_new` (
  `internal_id` int(11) NOT NULL,
  `legacy_comment_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_comment_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_commenttopic_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `comment_text` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_author` text COLLATE utf8_unicode_ci NOT NULL,
  `commentShowID` int(11) NOT NULL DEFAULT '0',
  `comment_submit_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_active` tinyint(4) NOT NULL DEFAULT '0',
  `comment_author_email` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_connections`
--

CREATE TABLE `rhr_connections` (
  `internal_id` int(11) NOT NULL,
  `connection_type_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `from_external_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `to_external_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_connectiontypes`
--

CREATE TABLE `rhr_connectiontypes` (
  `internal_id` int(11) NOT NULL,
  `connection_type_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `connection_type_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_countryresolver`
--

CREATE TABLE `rhr_countryresolver` (
  `internal_id` tinyint(4) NOT NULL,
  `countryname` text COLLATE utf8_unicode_ci NOT NULL,
  `external_country_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country_name_display` text COLLATE utf8_unicode_ci NOT NULL,
  `country_name_sortable` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_dependencies`
--

CREATE TABLE `rhr_dependencies` (
  `internal_id` bigint(20) NOT NULL,
  `external_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dependencies` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_editlog`
--

CREATE TABLE `rhr_editlog` (
  `internal_id` bigint(20) NOT NULL,
  `external_revision_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `internal_revision_number` tinyint(4) NOT NULL,
  `external_target_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `external_user_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `moderation_state` tinyint(4) NOT NULL DEFAULT '0',
  `thumbs_up` smallint(6) NOT NULL DEFAULT '0',
  `thumbs_down` smallint(6) NOT NULL DEFAULT '0',
  `edited_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_encore1leaders`
--

CREATE TABLE `rhr_encore1leaders` (
  `internal_id` bigint(20) NOT NULL,
  `songNumber` smallint(6) DEFAULT NULL,
  `showID` int(11) NOT NULL DEFAULT '0',
  `MIN(livetracks_db.songNumber)` bigint(21) DEFAULT NULL,
  `trackID` int(11) NOT NULL DEFAULT '0',
  `COUNT(titleresolver.trackID)` bigint(21) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_encore2leaders`
--

CREATE TABLE `rhr_encore2leaders` (
  `internal_id` bigint(20) NOT NULL,
  `songNumber` smallint(6) DEFAULT NULL,
  `showID` int(11) NOT NULL DEFAULT '0',
  `MIN(livetracks_db.songNumber)` bigint(21) DEFAULT NULL,
  `trackID` int(11) NOT NULL DEFAULT '0',
  `COUNT(titleresolver.trackID)` bigint(21) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_eventresolver`
--

CREATE TABLE `rhr_eventresolver` (
  `internal_id` int(11) NOT NULL,
  `external_event_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `event_name_display` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `event_name_sortable` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_externalapiresolver`
--

CREATE TABLE `rhr_externalapiresolver` (
  `api_name_display` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_api_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_api_key` varchar(48) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_facebookconnect`
--

CREATE TABLE `rhr_facebookconnect` (
  `internal_id` int(11) NOT NULL,
  `fb_uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_gcQueue`
--

CREATE TABLE `rhr_gcQueue` (
  `internal_id` bigint(20) NOT NULL,
  `external_item_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `gc_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gc_dependencies` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_groupresolver`
--

CREATE TABLE `rhr_groupresolver` (
  `internal_id` int(11) NOT NULL,
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `group_name_display` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `group_name_sortable` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `external_country_id` varchar(16) COLLATE utf8_unicode_ci DEFAULT '0000000',
  `external_hometown_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modified_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_groupstatus`
--

CREATE TABLE `rhr_groupstatus` (
  `internal_id` bigint(20) NOT NULL,
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_groupthumbnails`
--

CREATE TABLE `rhr_groupthumbnails` (
  `internal_id` mediumint(9) NOT NULL,
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_image_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_hackErrorTrap`
--

CREATE TABLE `rhr_hackErrorTrap` (
  `internal_id` int(11) NOT NULL,
  `comment_submit_time` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_text` text COLLATE utf8_unicode_ci,
  `comment_author_ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_author` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `external_commenttopic_id` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_active` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_author_email` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `external_comment_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trap_errata` text COLLATE utf8_unicode_ci,
  `recaptcha_fail` char(1) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_images`
--

CREATE TABLE `rhr_images` (
  `internal_id` bigint(20) NOT NULL,
  `external_image_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_subject_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `location` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `imagecredit` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_jambaseresolver`
--

CREATE TABLE `rhr_jambaseresolver` (
  `internal_id` bigint(20) NOT NULL,
  `external_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `jambase_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_labelresolver`
--

CREATE TABLE `rhr_labelresolver` (
  `internal_id` int(11) NOT NULL,
  `external_label_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `label_name_display` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `label_name_sortable` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_labelshistory`
--

CREATE TABLE `rhr_labelshistory` (
  `internal_id` int(11) NOT NULL,
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_label_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `label_start_date` int(11) NOT NULL DEFAULT '0',
  `label_end_date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_livetracks`
--

CREATE TABLE `rhr_livetracks` (
  `internal_id` int(11) NOT NULL,
  `external_show_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `encore_level` smallint(6) NOT NULL DEFAULT '0',
  `songComments` text COLLATE utf8_unicode_ci,
  `songNumber` smallint(6) DEFAULT NULL,
  `external_song_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_songversion_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'a3CCr7tLcb7c150z',
  `nonstandard_track` tinyint(4) NOT NULL DEFAULT '0',
  `modified_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_livetracktyperesolver`
--

CREATE TABLE `rhr_livetracktyperesolver` (
  `internal_id` smallint(6) NOT NULL,
  `external_livesongtype_id` varchar(16) NOT NULL,
  `livesongtype_name_display` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_liveupdate`
--

CREATE TABLE `rhr_liveupdate` (
  `internal_id` tinyint(4) NOT NULL,
  `linknum` tinyint(4) NOT NULL DEFAULT '0',
  `operator` text COLLATE utf8_unicode_ci NOT NULL,
  `linkshow` int(11) NOT NULL DEFAULT '0',
  `linktime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `linkstatus` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_localityresolver`
--

CREATE TABLE `rhr_localityresolver` (
  `internal_id` int(4) NOT NULL,
  `external_locale_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `locale_name_display` text COLLATE utf8_unicode_ci NOT NULL,
  `locale_name_sortable` text COLLATE utf8_unicode_ci NOT NULL,
  `locale_name_abbr` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localename` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `internal_country_id` tinyint(4) NOT NULL DEFAULT '0',
  `external_country_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_mbzresolver`
--

CREATE TABLE `rhr_mbzresolver` (
  `internal_id` int(11) NOT NULL,
  `external_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `mbz_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_mediatyperesolver`
--

CREATE TABLE `rhr_mediatyperesolver` (
  `internal_id` tinyint(4) NOT NULL,
  `external_mediatype_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mediatypename` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_openidresolver`
--

CREATE TABLE `rhr_openidresolver` (
  `internal_id` int(11) NOT NULL,
  `external_user_id` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `openID_identity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `openID_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `logins` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_people_old`
--

CREATE TABLE `rhr_people_old` (
  `internal_id` bigint(20) NOT NULL,
  `external_person_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `person_name_display` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `person_name_sortable` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_performances`
--

CREATE TABLE `rhr_performances` (
  `internal_id` int(11) NOT NULL,
  `legacy_show_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '9999',
  `external_show_id` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `external_venue_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_tour_id` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `showactive` tinyint(4) NOT NULL DEFAULT '0',
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `setlist_complete` tinyint(4) NOT NULL DEFAULT '1',
  `setlist_in_order` tinyint(4) NOT NULL DEFAULT '1',
  `external_event_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1CeEjHHbMKMOaDxD',
  `showDate` date NOT NULL DEFAULT '0000-00-00',
  `show_start_time` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `show_comments` text COLLATE utf8_unicode_ci,
  `performance_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_ratings`
--

CREATE TABLE `rhr_ratings` (
  `internal_id` int(11) NOT NULL,
  `external_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_target_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `rating_value` float NOT NULL DEFAULT '0',
  `external_ratingcategory_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_rating_categories`
--

CREATE TABLE `rhr_rating_categories` (
  `internal_id` smallint(6) NOT NULL,
  `external_ratingcategory_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ratingcategory_name_display` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_ratingtarget_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_reccontributors`
--

CREATE TABLE `rhr_reccontributors` (
  `internal_id` int(11) NOT NULL,
  `external_role_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `external_target_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `external_subject_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_relationships`
--

CREATE TABLE `rhr_relationships` (
  `internal_id` int(11) NOT NULL,
  `external_rel_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `external_object_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `external_target_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `external_reltype_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_relationshiptypes`
--

CREATE TABLE `rhr_relationshiptypes` (
  `internal_id` int(11) NOT NULL,
  `external_reltype_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `short_desc` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `long_desc` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_releaseresolver`
--

CREATE TABLE `rhr_releaseresolver` (
  `internal_id` int(11) NOT NULL,
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_album_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_country_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_label_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_releaseversion_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NMrdZTC8KpSffsMZ',
  `itunes_link` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ReleaseTitle` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `mediaType` text COLLATE utf8_unicode_ci,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `release_date` date DEFAULT NULL,
  `ReleaseType` text COLLATE utf8_unicode_ci,
  `ReleaseCatNumber` text COLLATE utf8_unicode_ci,
  `ReleaseArtist` text COLLATE utf8_unicode_ci,
  `releaseLabel` text COLLATE utf8_unicode_ci,
  `imgUrlSmall` text COLLATE utf8_unicode_ci,
  `imgUrlMed` text COLLATE utf8_unicode_ci,
  `imgUrlLg` text COLLATE utf8_unicode_ci,
  `amazonLink` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  `release_year` int(4) NOT NULL DEFAULT '0',
  `external_release_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_releaseversionresolver`
--

CREATE TABLE `rhr_releaseversionresolver` (
  `internal_id` smallint(6) NOT NULL,
  `external_releaseversion_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `releaseversion_name_display` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_roleresolver`
--

CREATE TABLE `rhr_roleresolver` (
  `internal_id` int(11) NOT NULL,
  `external_role_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `roleTitle` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_setlistsources`
--

CREATE TABLE `rhr_setlistsources` (
  `internal_id` int(11) NOT NULL,
  `external_show_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `setlist_url` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_songdetails`
--

CREATE TABLE `rhr_songdetails` (
  `internalID` int(11) NOT NULL,
  `trackID` int(11) NOT NULL DEFAULT '0',
  `trackTitle` text CHARACTER SET latin1 NOT NULL,
  `byWho` text CHARACTER SET latin1 NOT NULL,
  `lyrics` text CHARACTER SET latin1,
  `notes` text CHARACTER SET latin1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_songversionresolver`
--

CREATE TABLE `rhr_songversionresolver` (
  `internal_id` bigint(20) NOT NULL,
  `external_songversion_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `songversion_name_display` text COLLATE utf8_unicode_ci NOT NULL,
  `songversion_name_sortable` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_studioresolver`
--

CREATE TABLE `rhr_studioresolver` (
  `internal_id` int(11) NOT NULL,
  `external_studio_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_city_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `studio_name_display` text COLLATE utf8_unicode_ci NOT NULL,
  `studio_name_sortable` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_studiotracks`
--

CREATE TABLE `rhr_studiotracks` (
  `internal_id` int(11) NOT NULL,
  `external_release_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `internal_release_id` int(11) DEFAULT NULL,
  `external_song_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_songrecording_id` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_songversion_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'a3CCr7tLcb7c150z',
  `trackName` text COLLATE utf8_unicode_ci,
  `trackResID` int(11) DEFAULT NULL,
  `verResID` int(11) DEFAULT NULL,
  `trackType` text COLLATE utf8_unicode_ci NOT NULL,
  `trackNum` int(2) DEFAULT NULL,
  `trackTime` datetime DEFAULT NULL,
  `trackArtist` text COLLATE utf8_unicode_ci,
  `trackNotes` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_subdomains`
--

CREATE TABLE `rhr_subdomains` (
  `internal_id` int(11) NOT NULL,
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `subdomain_name_display` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `stylesheet_url` varchar(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'styles.css',
  `header_url` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `smallheader_url` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tracking_string` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `recaptcha_public_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `recaptcha_private_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `quantcast_tag_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_supportreference`
--

CREATE TABLE `rhr_supportreference` (
  `internal_id` int(11) NOT NULL,
  `internal_show_id` int(11) NOT NULL DEFAULT '0',
  `internal_support_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_tags`
--

CREATE TABLE `rhr_tags` (
  `internal_id` int(11) NOT NULL,
  `external_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tag_name_display` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_external_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_titleresolver`
--

CREATE TABLE `rhr_titleresolver` (
  `internal_id` int(11) NOT NULL,
  `external_song_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `song_name_display` text COLLATE utf8_unicode_ci NOT NULL,
  `song_name_sortable` text COLLATE utf8_unicode_ci NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_touringmembers`
--

CREATE TABLE `rhr_touringmembers` (
  `internal_id` int(11) NOT NULL,
  `external_artist_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_group_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_tourresolver`
--

CREATE TABLE `rhr_tourresolver` (
  `internal_id` int(11) NOT NULL,
  `tourname` text COLLATE utf8_unicode_ci NOT NULL,
  `priortour` smallint(6) NOT NULL DEFAULT '0',
  `external_tour_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tour_name_display` text COLLATE utf8_unicode_ci NOT NULL,
  `tour_name_sortable` text COLLATE utf8_unicode_ci NOT NULL,
  `prior_tour_id` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_userimages`
--

CREATE TABLE `rhr_userimages` (
  `internal_id` mediumint(9) NOT NULL,
  `photoLoc` text COLLATE utf8_unicode_ci NOT NULL,
  `photo_w` int(11) NOT NULL DEFAULT '0',
  `photo_h` int(11) NOT NULL DEFAULT '0',
  `photoTbLoc` text COLLATE utf8_unicode_ci NOT NULL,
  `photoTitle` text COLLATE utf8_unicode_ci NOT NULL,
  `photoDate` date NOT NULL DEFAULT '0000-00-00',
  `internal_show_id` mediumint(9) NOT NULL DEFAULT '0',
  `internal_user_id` mediumint(9) NOT NULL DEFAULT '0',
  `photoStatus` tinyint(4) NOT NULL DEFAULT '0',
  `photoFlagged` smallint(6) NOT NULL DEFAULT '0',
  `fairGame` tinyint(4) NOT NULL DEFAULT '0',
  `timestamp_ed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_users`
--

CREATE TABLE `rhr_users` (
  `internal_id` int(11) NOT NULL,
  `legacy_user_id` bigint(20) NOT NULL DEFAULT '0',
  `external_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_uname` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fb_uname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pn_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_regdate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pn_pass` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_interim_pass` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pn_bio` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_reg_band` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `login_times` smallint(6) NOT NULL DEFAULT '0',
  `salted` tinyint(4) NOT NULL DEFAULT '0',
  `client_key_pass` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_key_userid` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_key_issued` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `client_key_ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_changed_times` smallint(6) NOT NULL DEFAULT '0',
  `password_last_changed` datetime DEFAULT NULL,
  `record_last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_usershows`
--

CREATE TABLE `rhr_usershows` (
  `internal_id` int(11) NOT NULL,
  `external_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_show_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `internal_user_id` int(11) NOT NULL DEFAULT '0',
  `internal_show_id` int(11) NOT NULL DEFAULT '0',
  `claimed_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_usershows_new`
--

CREATE TABLE `rhr_usershows_new` (
  `internal_id` int(11) NOT NULL,
  `external_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_show_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `internal_user_id` int(11) NOT NULL DEFAULT '0',
  `internal_show_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_usersubmitted_livetracks`
--

CREATE TABLE `rhr_usersubmitted_livetracks` (
  `internal_id` bigint(20) NOT NULL,
  `external_show_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_song_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `songNumber` int(11) NOT NULL DEFAULT '0',
  `encore_level` tinyint(4) NOT NULL DEFAULT '0',
  `external_songversion_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_users_new`
--

CREATE TABLE `rhr_users_new` (
  `internal_id` int(11) NOT NULL,
  `legacy_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_uname` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_femail` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_url` varchar(254) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_avatar` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_regdate` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_icq` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_occ` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_from` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_intrest` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_sig` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_viewmail` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_theme` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_aim` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_yim` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_user_msnm` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_pass` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_storynum` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_umode` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_uorder` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_thold` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_noscore` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_bio` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_ublockon` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_ublock` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_theme` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_commentmax` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_counter` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pn_timezone_offset` float(3,1) NOT NULL DEFAULT '0.0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_usertyperesolver`
--

CREATE TABLE `rhr_usertyperesolver` (
  `internal_id` mediumint(9) NOT NULL,
  `internal_usertype_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `usertype_name` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_venueresolver`
--

CREATE TABLE `rhr_venueresolver` (
  `internal_id` int(4) NOT NULL,
  `legacy_venue_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `external_venue_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_venue_id` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venue_name_display` text COLLATE utf8_unicode_ci NOT NULL,
  `venue_name_sortable` text COLLATE utf8_unicode_ci NOT NULL,
  `venue_address` tinytext COLLATE utf8_unicode_ci,
  `venue_lat` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venue_lng` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `internal_city_id` int(4) NOT NULL DEFAULT '0',
  `external_city_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `venuecapacity` mediumint(9) DEFAULT NULL,
  `is_festival_venue` tinyint(4) NOT NULL DEFAULT '0',
  `modified_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_versionresolver`
--

CREATE TABLE `rhr_versionresolver` (
  `internal_id` smallint(6) NOT NULL,
  `versiontitle` text COLLATE utf8_unicode_ci NOT NULL,
  `external_version_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr_yahoomusicresolver`
--

CREATE TABLE `rhr_yahoomusicresolver` (
  `internal_id` bigint(20) NOT NULL,
  `external_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `yahoo_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr__global_idtracker`
--

CREATE TABLE `rhr__global_idtracker` (
  `internal_id` bigint(20) NOT NULL,
  `external_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `id_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rhr__global_idtyperesolver`
--

CREATE TABLE `rhr__global_idtyperesolver` (
  `internal_id` bigint(20) NOT NULL,
  `external_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `id_type` varchar(24) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cake_randoms`
--
ALTER TABLE `cake_randoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cake_shows`
--
ALTER TABLE `cake_shows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rhr_adminaccess_groups`
--
ALTER TABLE `rhr_adminaccess_groups`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_group_id` (`external_group_id`),
  ADD KEY `adminkey` (`adminkey`);

--
-- Indexes for table `rhr_adminkeys`
--
ALTER TABLE `rhr_adminkeys`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `adminkey` (`adminkey`),
  ADD UNIQUE KEY `external_user_id` (`external_user_id`),
  ADD KEY `keyvalid` (`keyvalid`),
  ADD KEY `keylevel` (`keylevel`);

--
-- Indexes for table `rhr_adqueue`
--
ALTER TABLE `rhr_adqueue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`,`width`,`height`),
  ADD KEY `group` (`group`);

--
-- Indexes for table `rhr_albumresolver`
--
ALTER TABLE `rhr_albumresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_album_id` (`external_album_id`),
  ADD KEY `external_group_id` (`external_group_id`),
  ADD KEY `external_albumtype_id` (`external_albumtype_id`),
  ADD KEY `default_external_release_id` (`default_external_release_id`);

--
-- Indexes for table `rhr_albums`
--
ALTER TABLE `rhr_albums`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_album_id` (`external_album_id`),
  ADD KEY `external_country_id` (`external_country_id`),
  ADD KEY `external_label_id` (`external_label_id`);
ALTER TABLE `rhr_albums` ADD FULLTEXT KEY `ReleaseTitle` (`ReleaseTitle`);

--
-- Indexes for table `rhr_albumtyperesolver`
--
ALTER TABLE `rhr_albumtyperesolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_albumtype_id` (`external_albumtype_id`);

--
-- Indexes for table `rhr_alternatetitles`
--
ALTER TABLE `rhr_alternatetitles`
  ADD PRIMARY KEY (`internal_id`);

--
-- Indexes for table `rhr_alternatevenuenames`
--
ALTER TABLE `rhr_alternatevenuenames`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_venue_id` (`primary_external_venue_id`),
  ADD KEY `external_city_id` (`external_city_id`),
  ADD KEY `alt_external_venue_id` (`alt_external_venue_id`);

--
-- Indexes for table `rhr_altlivetracks`
--
ALTER TABLE `rhr_altlivetracks`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_show_id` (`external_show_id`,`encore_level`,`external_song_id`,`setlist_author_id`),
  ADD KEY `external_setlist_id` (`external_setlist_id`);

--
-- Indexes for table `rhr_annotations`
--
ALTER TABLE `rhr_annotations`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_id` (`external_id`,`annotation_timestamp`,`annotation_author`);

--
-- Indexes for table `rhr_artistresolver`
--
ALTER TABLE `rhr_artistresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_person_id` (`external_artist_id`),
  ADD KEY `external_hometown_id` (`external_hometown_id`);

--
-- Indexes for table `rhr_artistresolver_old`
--
ALTER TABLE `rhr_artistresolver_old`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_artist_id` (`external_artist_id`);

--
-- Indexes for table `rhr_artistroles`
--
ALTER TABLE `rhr_artistroles`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_artist_id` (`external_artist_id`),
  ADD KEY `external_group_id` (`external_group_id`),
  ADD KEY `external_role_id` (`external_role_id`);

--
-- Indexes for table `rhr_artistthumbnails`
--
ALTER TABLE `rhr_artistthumbnails`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_artist_id` (`external_artist_id`),
  ADD UNIQUE KEY `external_image_id` (`external_image_id`);

--
-- Indexes for table `rhr_bandgroupings`
--
ALTER TABLE `rhr_bandgroupings`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_artist_id` (`external_artist_id`),
  ADD KEY `external_group_id` (`external_group_id`),
  ADD KEY `timestamp` (`timestamp`),
  ADD KEY `rel_start` (`rel_start`,`rel_end`);

--
-- Indexes for table `rhr_bandgroupings_former`
--
ALTER TABLE `rhr_bandgroupings_former`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_group_id` (`external_group_id`),
  ADD KEY `external_artist_id` (`external_artist_id`);

--
-- Indexes for table `rhr_bio`
--
ALTER TABLE `rhr_bio`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_group_id` (`external_id`);

--
-- Indexes for table `rhr_cityresolver`
--
ALTER TABLE `rhr_cityresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_city_id` (`external_city_id`),
  ADD KEY `localityID` (`internal_locale_id`),
  ADD KEY `external_locale_id` (`external_locale_id`),
  ADD KEY `city_lat` (`city_lat`),
  ADD KEY `city_lng` (`city_lng`);

--
-- Indexes for table `rhr_comments`
--
ALTER TABLE `rhr_comments`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_comment_id` (`external_comment_id`,`external_commenttopic_id`);

--
-- Indexes for table `rhr_comments_new`
--
ALTER TABLE `rhr_comments_new`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_comment_id` (`external_comment_id`,`external_commenttopic_id`);

--
-- Indexes for table `rhr_connections`
--
ALTER TABLE `rhr_connections`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `connection_type_id` (`connection_type_id`,`from_external_id`,`to_external_id`);

--
-- Indexes for table `rhr_connectiontypes`
--
ALTER TABLE `rhr_connectiontypes`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `connection_type_id` (`connection_type_id`);

--
-- Indexes for table `rhr_countryresolver`
--
ALTER TABLE `rhr_countryresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_country_id` (`external_country_id`);

--
-- Indexes for table `rhr_dependencies`
--
ALTER TABLE `rhr_dependencies`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_id` (`external_id`),
  ADD KEY `dependencies` (`dependencies`);

--
-- Indexes for table `rhr_editlog`
--
ALTER TABLE `rhr_editlog`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_target_id` (`external_target_id`,`external_user_id`),
  ADD KEY `external_edit_id` (`external_revision_id`),
  ADD KEY `admin_state` (`moderation_state`,`thumbs_up`,`thumbs_down`),
  ADD KEY `internal_revision_number` (`internal_revision_number`);

--
-- Indexes for table `rhr_encore1leaders`
--
ALTER TABLE `rhr_encore1leaders`
  ADD PRIMARY KEY (`internal_id`);

--
-- Indexes for table `rhr_encore2leaders`
--
ALTER TABLE `rhr_encore2leaders`
  ADD PRIMARY KEY (`internal_id`);

--
-- Indexes for table `rhr_eventresolver`
--
ALTER TABLE `rhr_eventresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_event_id` (`external_event_id`);
ALTER TABLE `rhr_eventresolver` ADD FULLTEXT KEY `eventname` (`event_name_display`);

--
-- Indexes for table `rhr_externalapiresolver`
--
ALTER TABLE `rhr_externalapiresolver`
  ADD UNIQUE KEY `external_api_id` (`external_api_id`);

--
-- Indexes for table `rhr_facebookconnect`
--
ALTER TABLE `rhr_facebookconnect`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `fb_uname` (`fb_uname`,`external_user_id`);

--
-- Indexes for table `rhr_gcQueue`
--
ALTER TABLE `rhr_gcQueue`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_item_id` (`external_item_id`);

--
-- Indexes for table `rhr_groupresolver`
--
ALTER TABLE `rhr_groupresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_artist_id` (`external_group_id`),
  ADD KEY `modified_timestamp` (`modified_timestamp`);

--
-- Indexes for table `rhr_groupstatus`
--
ALTER TABLE `rhr_groupstatus`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_group_id` (`external_group_id`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `rhr_groupthumbnails`
--
ALTER TABLE `rhr_groupthumbnails`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_artist_id` (`external_group_id`),
  ADD UNIQUE KEY `external_image_id` (`external_image_id`);

--
-- Indexes for table `rhr_hackErrorTrap`
--
ALTER TABLE `rhr_hackErrorTrap`
  ADD PRIMARY KEY (`internal_id`);

--
-- Indexes for table `rhr_images`
--
ALTER TABLE `rhr_images`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_image_id` (`external_image_id`),
  ADD KEY `external_subject_id` (`external_subject_id`);

--
-- Indexes for table `rhr_jambaseresolver`
--
ALTER TABLE `rhr_jambaseresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_id` (`external_id`),
  ADD KEY `jambase_id` (`jambase_id`);

--
-- Indexes for table `rhr_labelresolver`
--
ALTER TABLE `rhr_labelresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_label_id` (`external_label_id`);

--
-- Indexes for table `rhr_labelshistory`
--
ALTER TABLE `rhr_labelshistory`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_group_id` (`external_group_id`),
  ADD KEY `external_label_id` (`external_label_id`);

--
-- Indexes for table `rhr_livetracks`
--
ALTER TABLE `rhr_livetracks`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `showID_2` (`external_show_id`),
  ADD KEY `external_song_id` (`external_song_id`),
  ADD KEY `nonstandard_track` (`nonstandard_track`),
  ADD KEY `external_songversion_id` (`external_songversion_id`),
  ADD KEY `modified_timestamp` (`modified_timestamp`),
  ADD KEY `songNumber` (`songNumber`);

--
-- Indexes for table `rhr_livetracktyperesolver`
--
ALTER TABLE `rhr_livetracktyperesolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_livesongtype_id` (`external_livesongtype_id`);

--
-- Indexes for table `rhr_liveupdate`
--
ALTER TABLE `rhr_liveupdate`
  ADD PRIMARY KEY (`internal_id`);

--
-- Indexes for table `rhr_localityresolver`
--
ALTER TABLE `rhr_localityresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_locale_id` (`external_locale_id`),
  ADD KEY `countryID` (`internal_country_id`),
  ADD KEY `external_country_id` (`external_country_id`),
  ADD KEY `locale_name_abbr` (`locale_name_abbr`);

--
-- Indexes for table `rhr_mbzresolver`
--
ALTER TABLE `rhr_mbzresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_id` (`external_id`,`mbz_id`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `rhr_mediatyperesolver`
--
ALTER TABLE `rhr_mediatyperesolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_mediatype_id` (`external_mediatype_id`);

--
-- Indexes for table `rhr_openidresolver`
--
ALTER TABLE `rhr_openidresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_open_id` (`openID_identity`),
  ADD KEY `external_user_id` (`external_user_id`),
  ADD KEY `openID_provider` (`openID_provider`),
  ADD KEY `created` (`created`),
  ADD KEY `logins` (`logins`);

--
-- Indexes for table `rhr_people_old`
--
ALTER TABLE `rhr_people_old`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_person_id` (`external_person_id`);

--
-- Indexes for table `rhr_performances`
--
ALTER TABLE `rhr_performances`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `showDate` (`showDate`),
  ADD KEY `showactive` (`showactive`),
  ADD KEY `artist` (`external_group_id`),
  ADD KEY `f8_show_id` (`external_show_id`),
  ADD KEY `setlist_complete` (`setlist_complete`,`setlist_in_order`),
  ADD KEY `show_start_time` (`show_start_time`),
  ADD KEY `performance_timestamp` (`performance_timestamp`),
  ADD KEY `external_event_id` (`external_event_id`),
  ADD KEY `external_venue_id` (`external_venue_id`),
  ADD KEY `external_tour_id` (`external_tour_id`);

--
-- Indexes for table `rhr_ratings`
--
ALTER TABLE `rhr_ratings`
  ADD PRIMARY KEY (`internal_id`);

--
-- Indexes for table `rhr_rating_categories`
--
ALTER TABLE `rhr_rating_categories`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_ratingcategory_id` (`external_ratingcategory_id`,`external_ratingtarget_id`);

--
-- Indexes for table `rhr_reccontributors`
--
ALTER TABLE `rhr_reccontributors`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_role_id` (`external_role_id`,`external_target_id`,`external_subject_id`);

--
-- Indexes for table `rhr_relationships`
--
ALTER TABLE `rhr_relationships`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_rel_id` (`external_rel_id`),
  ADD KEY `external_object_id` (`external_object_id`,`external_target_id`,`external_reltype_id`);

--
-- Indexes for table `rhr_relationshiptypes`
--
ALTER TABLE `rhr_relationshiptypes`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_reltype_id` (`external_reltype_id`);

--
-- Indexes for table `rhr_releaseresolver`
--
ALTER TABLE `rhr_releaseresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_release_id` (`external_release_id`),
  ADD KEY `external_country_id` (`external_country_id`),
  ADD KEY `external_label_id` (`external_label_id`),
  ADD KEY `external_album_id` (`external_album_id`),
  ADD KEY `external_releaseversion_id` (`external_releaseversion_id`),
  ADD KEY `itunes_link` (`itunes_link`),
  ADD KEY `external_group_id` (`external_group_id`);
ALTER TABLE `rhr_releaseresolver` ADD FULLTEXT KEY `ReleaseTitle` (`ReleaseTitle`);

--
-- Indexes for table `rhr_releaseversionresolver`
--
ALTER TABLE `rhr_releaseversionresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_releaseversion_id` (`external_releaseversion_id`);

--
-- Indexes for table `rhr_roleresolver`
--
ALTER TABLE `rhr_roleresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_role_id` (`external_role_id`);

--
-- Indexes for table `rhr_setlistsources`
--
ALTER TABLE `rhr_setlistsources`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_show_id` (`external_show_id`);

--
-- Indexes for table `rhr_songdetails`
--
ALTER TABLE `rhr_songdetails`
  ADD PRIMARY KEY (`internalID`),
  ADD KEY `trackID` (`trackID`);

--
-- Indexes for table `rhr_songversionresolver`
--
ALTER TABLE `rhr_songversionresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_songversion_id` (`external_songversion_id`);

--
-- Indexes for table `rhr_studioresolver`
--
ALTER TABLE `rhr_studioresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_studio_id` (`external_studio_id`),
  ADD KEY `external_city_id` (`external_city_id`);

--
-- Indexes for table `rhr_studiotracks`
--
ALTER TABLE `rhr_studiotracks`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_release_id` (`external_release_id`),
  ADD KEY `external_song_id` (`external_song_id`),
  ADD KEY `external_group_id` (`external_group_id`),
  ADD KEY `external_songversion_id` (`external_songversion_id`);

--
-- Indexes for table `rhr_subdomains`
--
ALTER TABLE `rhr_subdomains`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_grop_id` (`external_group_id`);

--
-- Indexes for table `rhr_supportreference`
--
ALTER TABLE `rhr_supportreference`
  ADD PRIMARY KEY (`internal_id`);

--
-- Indexes for table `rhr_tags`
--
ALTER TABLE `rhr_tags`
  ADD PRIMARY KEY (`internal_id`);

--
-- Indexes for table `rhr_titleresolver`
--
ALTER TABLE `rhr_titleresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_group_id` (`external_group_id`),
  ADD KEY `external_song_id` (`external_song_id`),
  ADD KEY `modified_time` (`modified_time`);
ALTER TABLE `rhr_titleresolver` ADD FULLTEXT KEY `trackID` (`song_name_display`);

--
-- Indexes for table `rhr_touringmembers`
--
ALTER TABLE `rhr_touringmembers`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_artist_id` (`external_artist_id`),
  ADD KEY `external_group_id` (`external_group_id`);

--
-- Indexes for table `rhr_tourresolver`
--
ALTER TABLE `rhr_tourresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_tour_id` (`external_tour_id`),
  ADD KEY `prior_tour_id` (`prior_tour_id`);

--
-- Indexes for table `rhr_userimages`
--
ALTER TABLE `rhr_userimages`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `photoStatus` (`photoStatus`);

--
-- Indexes for table `rhr_users`
--
ALTER TABLE `rhr_users`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `pn_uname` (`pn_uname`),
  ADD UNIQUE KEY `external_user_id` (`external_user_id`),
  ADD KEY `client_key` (`client_key_pass`),
  ADD KEY `client_key_userid` (`client_key_userid`),
  ADD KEY `client_key_ip` (`client_key_ip`),
  ADD KEY `password_changed_times` (`password_changed_times`),
  ADD KEY `record_last_updated` (`record_last_updated`),
  ADD KEY `user_reg_band` (`user_reg_band`),
  ADD KEY `fb_uname` (`fb_uname`);

--
-- Indexes for table `rhr_usershows`
--
ALTER TABLE `rhr_usershows`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_member_id` (`external_user_id`,`external_show_id`);

--
-- Indexes for table `rhr_usershows_new`
--
ALTER TABLE `rhr_usershows_new`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_member_id` (`external_user_id`,`external_show_id`);

--
-- Indexes for table `rhr_usersubmitted_livetracks`
--
ALTER TABLE `rhr_usersubmitted_livetracks`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_show_id` (`external_show_id`,`external_user_id`,`external_song_id`,`songNumber`,`encore_level`,`external_songversion_id`);

--
-- Indexes for table `rhr_users_new`
--
ALTER TABLE `rhr_users_new`
  ADD PRIMARY KEY (`internal_id`);

--
-- Indexes for table `rhr_usertyperesolver`
--
ALTER TABLE `rhr_usertyperesolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `internal_usertype_id` (`internal_usertype_id`);

--
-- Indexes for table `rhr_venueresolver`
--
ALTER TABLE `rhr_venueresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_venue_id` (`external_venue_id`),
  ADD KEY `venue_lat` (`venue_lat`,`venue_lng`),
  ADD KEY `modified_timestamp` (`modified_timestamp`),
  ADD KEY `internal_city_id` (`internal_city_id`),
  ADD KEY `is_festival_venue` (`is_festival_venue`),
  ADD KEY `parent_venue_id` (`parent_venue_id`);

--
-- Indexes for table `rhr_versionresolver`
--
ALTER TABLE `rhr_versionresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD KEY `external_version_id` (`external_version_id`);

--
-- Indexes for table `rhr_yahoomusicresolver`
--
ALTER TABLE `rhr_yahoomusicresolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_id_2` (`external_id`);

--
-- Indexes for table `rhr__global_idtracker`
--
ALTER TABLE `rhr__global_idtracker`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_id` (`external_id`);

--
-- Indexes for table `rhr__global_idtyperesolver`
--
ALTER TABLE `rhr__global_idtyperesolver`
  ADD PRIMARY KEY (`internal_id`),
  ADD UNIQUE KEY `external_id` (`external_id`),
  ADD KEY `id_type` (`id_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rhr_adminkeys`
--
ALTER TABLE `rhr_adminkeys`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rhr_adqueue`
--
ALTER TABLE `rhr_adqueue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `rhr_albumresolver`
--
ALTER TABLE `rhr_albumresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;
--
-- AUTO_INCREMENT for table `rhr_albums`
--
ALTER TABLE `rhr_albums`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;
--
-- AUTO_INCREMENT for table `rhr_albumtyperesolver`
--
ALTER TABLE `rhr_albumtyperesolver`
  MODIFY `internal_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `rhr_alternatetitles`
--
ALTER TABLE `rhr_alternatetitles`
  MODIFY `internal_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `rhr_alternatevenuenames`
--
ALTER TABLE `rhr_alternatevenuenames`
  MODIFY `internal_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `rhr_altlivetracks`
--
ALTER TABLE `rhr_altlivetracks`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_annotations`
--
ALTER TABLE `rhr_annotations`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_artistresolver`
--
ALTER TABLE `rhr_artistresolver`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3020;
--
-- AUTO_INCREMENT for table `rhr_artistresolver_old`
--
ALTER TABLE `rhr_artistresolver_old`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `rhr_artistroles`
--
ALTER TABLE `rhr_artistroles`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `rhr_artistthumbnails`
--
ALTER TABLE `rhr_artistthumbnails`
  MODIFY `internal_id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_bandgroupings`
--
ALTER TABLE `rhr_bandgroupings`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3127;
--
-- AUTO_INCREMENT for table `rhr_bandgroupings_former`
--
ALTER TABLE `rhr_bandgroupings_former`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;
--
-- AUTO_INCREMENT for table `rhr_bio`
--
ALTER TABLE `rhr_bio`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rhr_cityresolver`
--
ALTER TABLE `rhr_cityresolver`
  MODIFY `internal_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1030;
--
-- AUTO_INCREMENT for table `rhr_comments`
--
ALTER TABLE `rhr_comments`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1815;
--
-- AUTO_INCREMENT for table `rhr_comments_new`
--
ALTER TABLE `rhr_comments_new`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=714;
--
-- AUTO_INCREMENT for table `rhr_connections`
--
ALTER TABLE `rhr_connections`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_connectiontypes`
--
ALTER TABLE `rhr_connectiontypes`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_countryresolver`
--
ALTER TABLE `rhr_countryresolver`
  MODIFY `internal_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `rhr_dependencies`
--
ALTER TABLE `rhr_dependencies`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_editlog`
--
ALTER TABLE `rhr_editlog`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_encore1leaders`
--
ALTER TABLE `rhr_encore1leaders`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `rhr_encore2leaders`
--
ALTER TABLE `rhr_encore2leaders`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `rhr_eventresolver`
--
ALTER TABLE `rhr_eventresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `rhr_facebookconnect`
--
ALTER TABLE `rhr_facebookconnect`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_gcQueue`
--
ALTER TABLE `rhr_gcQueue`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `rhr_groupresolver`
--
ALTER TABLE `rhr_groupresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2801;
--
-- AUTO_INCREMENT for table `rhr_groupstatus`
--
ALTER TABLE `rhr_groupstatus`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1094;
--
-- AUTO_INCREMENT for table `rhr_groupthumbnails`
--
ALTER TABLE `rhr_groupthumbnails`
  MODIFY `internal_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=679;
--
-- AUTO_INCREMENT for table `rhr_hackErrorTrap`
--
ALTER TABLE `rhr_hackErrorTrap`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=930;
--
-- AUTO_INCREMENT for table `rhr_images`
--
ALTER TABLE `rhr_images`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=703;
--
-- AUTO_INCREMENT for table `rhr_jambaseresolver`
--
ALTER TABLE `rhr_jambaseresolver`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36327;
--
-- AUTO_INCREMENT for table `rhr_labelresolver`
--
ALTER TABLE `rhr_labelresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `rhr_labelshistory`
--
ALTER TABLE `rhr_labelshistory`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rhr_livetracks`
--
ALTER TABLE `rhr_livetracks`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13480;
--
-- AUTO_INCREMENT for table `rhr_livetracktyperesolver`
--
ALTER TABLE `rhr_livetracktyperesolver`
  MODIFY `internal_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rhr_liveupdate`
--
ALTER TABLE `rhr_liveupdate`
  MODIFY `internal_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `rhr_localityresolver`
--
ALTER TABLE `rhr_localityresolver`
  MODIFY `internal_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;
--
-- AUTO_INCREMENT for table `rhr_mbzresolver`
--
ALTER TABLE `rhr_mbzresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5805;
--
-- AUTO_INCREMENT for table `rhr_mediatyperesolver`
--
ALTER TABLE `rhr_mediatyperesolver`
  MODIFY `internal_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rhr_openidresolver`
--
ALTER TABLE `rhr_openidresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `rhr_people_old`
--
ALTER TABLE `rhr_people_old`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `rhr_performances`
--
ALTER TABLE `rhr_performances`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35928;
--
-- AUTO_INCREMENT for table `rhr_ratings`
--
ALTER TABLE `rhr_ratings`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `rhr_rating_categories`
--
ALTER TABLE `rhr_rating_categories`
  MODIFY `internal_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `rhr_reccontributors`
--
ALTER TABLE `rhr_reccontributors`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `rhr_releaseresolver`
--
ALTER TABLE `rhr_releaseresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;
--
-- AUTO_INCREMENT for table `rhr_releaseversionresolver`
--
ALTER TABLE `rhr_releaseversionresolver`
  MODIFY `internal_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rhr_roleresolver`
--
ALTER TABLE `rhr_roleresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `rhr_setlistsources`
--
ALTER TABLE `rhr_setlistsources`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `rhr_songdetails`
--
ALTER TABLE `rhr_songdetails`
  MODIFY `internalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `rhr_songversionresolver`
--
ALTER TABLE `rhr_songversionresolver`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `rhr_studioresolver`
--
ALTER TABLE `rhr_studioresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_studiotracks`
--
ALTER TABLE `rhr_studiotracks`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1743;
--
-- AUTO_INCREMENT for table `rhr_subdomains`
--
ALTER TABLE `rhr_subdomains`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `rhr_supportreference`
--
ALTER TABLE `rhr_supportreference`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `rhr_tags`
--
ALTER TABLE `rhr_tags`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_titleresolver`
--
ALTER TABLE `rhr_titleresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1862;
--
-- AUTO_INCREMENT for table `rhr_touringmembers`
--
ALTER TABLE `rhr_touringmembers`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_tourresolver`
--
ALTER TABLE `rhr_tourresolver`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `rhr_userimages`
--
ALTER TABLE `rhr_userimages`
  MODIFY `internal_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `rhr_users`
--
ALTER TABLE `rhr_users`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2411;
--
-- AUTO_INCREMENT for table `rhr_usershows`
--
ALTER TABLE `rhr_usershows`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6786;
--
-- AUTO_INCREMENT for table `rhr_usershows_new`
--
ALTER TABLE `rhr_usershows_new`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1674;
--
-- AUTO_INCREMENT for table `rhr_usersubmitted_livetracks`
--
ALTER TABLE `rhr_usersubmitted_livetracks`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rhr_users_new`
--
ALTER TABLE `rhr_users_new`
  MODIFY `internal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1032;
--
-- AUTO_INCREMENT for table `rhr_usertyperesolver`
--
ALTER TABLE `rhr_usertyperesolver`
  MODIFY `internal_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rhr_venueresolver`
--
ALTER TABLE `rhr_venueresolver`
  MODIFY `internal_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2828;
--
-- AUTO_INCREMENT for table `rhr_versionresolver`
--
ALTER TABLE `rhr_versionresolver`
  MODIFY `internal_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `rhr_yahoomusicresolver`
--
ALTER TABLE `rhr_yahoomusicresolver`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2193;
--
-- AUTO_INCREMENT for table `rhr__global_idtracker`
--
ALTER TABLE `rhr__global_idtracker`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55378;
--
-- AUTO_INCREMENT for table `rhr__global_idtyperesolver`
--
ALTER TABLE `rhr__global_idtyperesolver`
  MODIFY `internal_id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
