-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Sie 2021, 21:12
-- Wersja serwera: 10.4.20-MariaDB
-- Wersja PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shopcashout`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `discount`
--

CREATE TABLE `discount` (
  `IDDiscount` int(11) NOT NULL,
  `DiscountCode` varchar(255) NOT NULL,
  `DiscountAmount` int(11) NOT NULL,
  `DiscountIsOnline` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `discount`
--

INSERT INTO `discount` (`IDDiscount`, `DiscountCode`, `DiscountAmount`, `DiscountIsOnline`) VALUES
(1, 'SMARTBEES', 19, 1),
(2, 'WIOSNA20', 20, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `IDOrders` int(11) NOT NULL,
  `OrdersIDUser` int(11) NOT NULL,
  `OrdersIDShippment` int(11) NOT NULL,
  `OrdersIDPayment` int(11) NOT NULL,
  `OrdersPrice` float NOT NULL,
  `OrdersQuantity` int(11) NOT NULL,
  `OrdersComment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment`
--

CREATE TABLE `payment` (
  `IDPayment` int(11) NOT NULL,
  `PaymentMethod` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `payment`
--

INSERT INTO `payment` (`IDPayment`, `PaymentMethod`) VALUES
(1, 'PayU'),
(2, 'Płatność przy odbiorze'),
(3, 'Przelew bankowy - zwykły');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `productorders`
--

CREATE TABLE `productorders` (
  `IDOrders` int(11) NOT NULL,
  `IDProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `IDProduct` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductPrice` float NOT NULL,
  `ProductPhoto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`IDProduct`, `ProductName`, `ProductPrice`, `ProductPhoto`) VALUES
(1, 'Testowy produkt', 100, 0x89504e470d0a1a0a0000000d49484452000000ed0000006b080200000014c6921d000000017352474200aece1ce90000000467414d410000b18f0bfc61050000000970485973000012740000127401de661f780000070a49444154785eeddc418ee23c1005e0be65df81238cc4b6d7481c00b166c78a4108d19a8bfd313c882baeb8cac9fc50d3bc4f5eb5aa8de3bc386e48f3414444444444ba3f44ff0844568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c24364552899e7b25efcfef539dabe16c7f5f2bcdb7fa37c94ddcfd7f2bcd99afd8cdb5f36ab53ea47f47c748ff0c118eaafee2516a7f5aaeb13bfe0b23d3d06b66e38cccbe63198c5f9801f4adbb3bfe7ddf288de3e8f9b6df783efbeff89edb4bb753d0b22ab42c92cdb5331ee91b6386d2ae7d5dfcfe7b1e53427872c22d5e6ebb961a85d3bae57173d5ed261f508d0efaf55cb45d5bfd64862b201d77bcec790729cce57deffb476eb67264456859259da4eeaf83cb6f6b3bce017ebf6d6da59b685b57e340e35b5fa357cf5fa1ccbe35aa7c5b8f37e39feea169efd77de76dbf37a915fe2a9dd2748b2fad9f4f7bb479975b2f7fdfdb46fdd1dbfdb456c2fd7765e2fd5a5ba1ae5ea500ffb5bb7c3d176adbed8bf38c772ae44593a22b57527f7f12be9b65314dc9aff582a1059154a6671cdd1e09ad6a6dbd98f585ceb0be77021e996f0d1fb7bb96c8fed353b9ea126dfbb6e3bfee8f0daf46bf8eaa5399673e5bcd789adf35f59742b1059154a66719e5479b92ba7f36ff573b75bf66569b5b05785efec4f9cd44687e1cdf1d5f09e307aedbd30c762ae2a17f0d01be6783059e5153fa99fd1caacb7ae55e23e20d33f79799306511e59ed5e95e3fc752b9799e62d732cb2555ef4ee7ec4bc8f64c2b8662a3ceb7d6b8e8759d14ff96b729c9f94e62c32c7ff6b8e45169be7d7be06fc87dc13efc2aabff5821cbb37692398e31939b6f715f51732e5bfae26c37fc81971f969a37a7a8eed4bcbf2963936d651673f8eb576faa6e2c67c89493996dd2a817b728ee7ce52f28e39b6ae7e573fa29391d91735edf7ca8ed5c3b41c8bc02967fd9939366f0e3e6f98e3ac6cca22b72fdf8b1d3967e2bc86cab1d1edf3722ccec5d8347abc598e878f37587f3cd9adb68418cb9e87b1059f9863a3db27e5587c7e39337c3f36c7830f692f6911cd16a1d4c622e8ccf1e2643df2c61c17f2018bc70498e30767fe6eadf2088eaf9fafa5b999638e0b72c0f930b8afb8f3e6d87a7c51cc75beae5f864f08197f9784cd7198fdb11cc9d4372b3aef93e3f4f0bbb913b8aa8743be635f9dfaf9393602f7efe778389f2d2f97fba1399e3a1d57663f8e778eafac14daac2b61e2211bdd3e35c7f2e5ba3669a298e392a31fb1b11b5f928d5d81c9fac062e22107fb1ca4337ba3cc1c973cfdf89664b1d24c78933f1b89feeb930e598cca7ce7d1bf67cde7c4f15e901c707e0d4c982be6b8e4ebc7b5d6e681689e5fb12dd15f62ca218bc4e837714f224bf9c18ea5bf3260b134f80fe786392e39fbc94fdbe8ad5084a66d54a2ff9173d37ec87233ea19b63716ad1776593363a3cc1c97bcfd3816b6e1b9f14fb1bccf4e58de54ee35cff90740cfb7d1b2062c6e412d1b65e6b8e4eec7de68263291ddb9b16779703a27c7429221365292f5dc35eb7fb1e4802bb9b7072ca7cbbbab618e4bfe7e7c8bd0e076d955566271c8bea9e4d66ab757e750f7c37ff8739cecc1b5d4f53ff2e1d1f01f63ab3d7b069cd5d4ca04e6b8d4d08f38d995e22246d7fae5a9ff0ff555fa07fd4182534d7d00f950fbaf1078f47952fbbc5e48e8a066b87ea7963e4bba8f79b32c1e593137b5beb96ddf2833c7a5967ec48c576f82c5aa6c36c77f566743f5b685676373a74579bcb50db83ab783bb81b951668e4b6dfdb8feda03f7570aa5c5d573329a72bcf07ce540a9dc9368cd7979f8e7767009197f6bfea81cf7473ee984dd35f6b3eb17dadbd7e959d293f8e9cb8d8ae748f10448cb4700c68571fd4ac5b41338cc3db5f7318bfe6f5f82d8d279d3dce60f8b2fced525397b74cefc32b1b91059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c243645528210a0f9155a184283c44568512a2f01059154a88c24364898888888888e827faf8f80f1058352f037568790000000049454e44ae426082);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shippment`
--

CREATE TABLE `shippment` (
  `IDShippment` int(11) NOT NULL,
  `ShippmentMethod` varchar(40) NOT NULL,
  `ShippmentPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `shippment`
--

INSERT INTO `shippment` (`IDShippment`, `ShippmentMethod`, `ShippmentPrice`) VALUES
(1, 'Paczkomat', 10.99),
(2, 'Kurier DPD', 18),
(3, 'Kurier DPD Pobranie', 22);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `IDUser` int(11) NOT NULL,
  `UserLogin` varchar(255) DEFAULT NULL,
  `UserPassword` varchar(255) DEFAULT NULL,
  `UserName` varchar(20) NOT NULL,
  `UserSurname` varchar(30) NOT NULL,
  `UserCountry` varchar(30) NOT NULL,
  `UserAddress` varchar(50) NOT NULL,
  `UserZipcode` varchar(6) NOT NULL,
  `UserCity` varchar(30) NOT NULL,
  `UserPhone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`IDDiscount`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`IDOrders`),
  ADD KEY `OrdersIDUser` (`OrdersIDUser`),
  ADD KEY `OrdersIDPayment` (`OrdersIDPayment`),
  ADD KEY `OrdersIDShippment` (`OrdersIDShippment`);

--
-- Indeksy dla tabeli `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`IDPayment`);

--
-- Indeksy dla tabeli `productorders`
--
ALTER TABLE `productorders`
  ADD KEY `IDOrders` (`IDOrders`),
  ADD KEY `IDProduct` (`IDProduct`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`IDProduct`);

--
-- Indeksy dla tabeli `shippment`
--
ALTER TABLE `shippment`
  ADD PRIMARY KEY (`IDShippment`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IDUser`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `discount`
--
ALTER TABLE `discount`
  MODIFY `IDDiscount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `IDOrders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT dla tabeli `payment`
--
ALTER TABLE `payment`
  MODIFY `IDPayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `IDProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `shippment`
--
ALTER TABLE `shippment`
  MODIFY `IDShippment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `IDUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`OrdersIDUser`) REFERENCES `users` (`IDUser`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`OrdersIDPayment`) REFERENCES `payment` (`IDPayment`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`OrdersIDShippment`) REFERENCES `shippment` (`IDShippment`);

--
-- Ograniczenia dla tabeli `productorders`
--
ALTER TABLE `productorders`
  ADD CONSTRAINT `productorders_ibfk_1` FOREIGN KEY (`IDOrders`) REFERENCES `orders` (`IDOrders`),
  ADD CONSTRAINT `productorders_ibfk_2` FOREIGN KEY (`IDProduct`) REFERENCES `products` (`IDProduct`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
