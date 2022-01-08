create database DBS_project;
use DBS_project;

-- drop database DBS_project;

create table `Member`(
	`Member_ID` int not null AUTO_INCREMENT,
	`Member_name` VARCHAR(255) not null,
	`Username` VARCHAR(50) not null UNIQUE,
	`Member_password` VARCHAR(50) not null,
	`Email` VARCHAR(255) not null,
	`Phone` int not null,
	primary key(Member_ID)
);

-- describe `Member`;
-- delete from `Member` where member_ID; -- 清空
-- alter table `Member` AUTO_INCREMENT = 1; -- 重設id為1開始
select * from `Member`; -- 查詢 

create table Product(
	Product_ID int not null AUTO_INCREMENT,
	Product_name VARCHAR(50) not null,
    Product_description varchar(50) not null,
	Price INT not null,
	Stock INT not null,
	Publish_date DATETIME not null,
	Modified_date DATETIME,
    Product_detail VARCHAR(2000),
    Product_standerd VARCHAR(2000),
	primary key (Product_ID)
);
-- drop table Product;
insert into Product(Product_name, Product_description, Price, stock, Publish_date, Product_detail, Product_standerd)
values("佳德糕餅 - 鳳梨酥","原味鳳梨酥禮盒(12入)","750", 100, '2021-12-29',"詳細資訊","我是好吃的鳳梨酥"),
("佳德糕餅 - 蔥軋餅","蔥軋餅(24片)禮盒","750", 100, '2021-12-29',"詳細資訊","我是好吃的蔥軋餅"),
("佳德糕餅 - 太陽餅","太陽餅(12入)","416", 100, '2021-12-29',"詳細資訊","standerd"),
("阿聰師 - 阿聰師的小芋仔","阿聰師的小芋仔(6入) (蛋奶素)","430", 100, '2021-12-29',"詳細資訊","standerd"),
("阿聰師 - 大甲芋頭Q禮盒","大甲芋頭Q禮盒(麻糬)(9入)","352", 100, '2021-12-29',"詳細資訊","standerd"),
("阿聰師 - 大甲芋頭酥綜合禮盒","大甲芋頭酥綜合禮盒(9入)(蛋奶素)","7660", 100, '2021-12-29',"詳細資訊","standerd"),
("海邊走走 - 花生愛餡蛋捲","花生愛餡蛋捲(2盒一組)","460", 100, '2021-12-29',"詳細資訊","standerd"),
("海邊走走 - 鐵觀音茶蛋捲","鐵觀音茶蛋捲(2盒一組)","590", 100, '2021-12-29',"詳細資訊","standerd"),
("海邊走走 - 2022新春限定","HiNUTS海拿滋 大蒜滋腰果袋裝(4包)","346", 100, '2021-12-29',"詳細資訊","standerd"),
("老媽拌麵 - 蔥油開洋拌麵","蔥油開洋拌麵(一袋4包)","987", 100, '2021-12-29',"詳細資訊","standerd"),
("老媽拌麵 - 四川麻辣拌麵","四川麻辣拌麵","234", 100, '2021-12-29',"詳細資訊","standerd"),
("老媽拌麵 - 老成都擔擔拌麵","老成都擔擔拌麵(一袋4包)","436", 100, '2021-12-29',"詳細資訊","standerd"),
("老媽拌麵 - 麻辣芝士蘇打餅","麻辣芝士蘇打餅(190g/盒)","645", 100, '2021-12-29',"詳細資訊","standerd"),

("吾穀茶糧 SIID CHA - 四季擂茶(夏果)","四季擂茶(夏果) - 莓果東方美人茶","270", 100, '2021-12-29',"詳細資訊","standerd"),
("吾穀茶糧 SIID CHA - 四季擂茶(春果)","四季擂茶(春果) - 蕎麥碧 螺春","270", 100, '2021-12-29',"詳細資訊","standerd"),
("吾穀茶糧 SIID CHA - 四季擂茶(秋果)","四季擂茶(秋果) - 玫瑰紅玉紅茶","1250", 100, '2021-12-29',"詳細資訊","standerd"),
("小茶栽堂 - 紅雙禮盒","紅雙禮盒(古典罐2入-黑烏龍茶X古早味紅茶)","1300", 100, '2021-12-29',"詳細資訊","standerd"),
("小茶栽堂 - 小茶紅禮盒","小茶紅禮盒(古典罐2入-黑烏龍茶X黃梔烏龍茶)","870", 100, '2021-12-29',"詳細資訊","standerd"),
("小茶栽堂 - 清香烏龍茶","清雅藏香罐-清香烏龍茶","600", 100, '2021-12-29',"詳細資訊","standerd"),
("小茶栽堂 - 黃梔烏龍茶","古典罐-黃梔烏龍茶","810", 100, '2021-12-29',"詳細資訊","standerd"),
("小茶栽堂 - 輕巧盒(袋茶)","四入組-窨花(黃梔烏龍茶+烏龍茶+桂花綠茶+桂香金萱茶)","750", 100, '2021-12-29',"詳細資訊","standerd"),

("客廳裝飾品 玄關擺飾 招財鹿 歐式擺件","貨品需等15至20天","1230", 100, '2021-12-29',"詳細資訊","standerd"),
("聖誕發光擺件 聖誕節裝飾品","現貨","450", 100, '2021-12-29',"詳細資訊","standerd"),

("老爸的開心農場 新鮮芭樂","新鮮芭樂(自產自銷 新鮮採收寄出)","40", 100, '2021-12-29',"詳細資訊","standerd"),
("金煌芒果 大粒香甜黃金寶","金煌芒果(果農新鮮現採 產地直送)","480", 100, '2021-12-29',"詳細資訊","standerd"),
("苗栗大湖草莓","草莓新鮮現採出貨/盒","700", 100, '2021-12-29',"詳細資訊","standerd"),
("九如檸檬 大斤數含運組合","檸檬(新鮮現採 當日直送)/盒","800", 100, '2021-12-29',"詳細資訊","standerd");

-- delete from `Product` where Product_ID;
-- alter table `Product` AUTO_INCREMENT = 1;

create table Category(
	Product_ID int not null,
	Category_name VARCHAR(50) not null,
	primary key (Product_ID) ,
	foreign key (Product_ID) references Product(Product_ID) on update cascade on delete cascade
);
insert into Category(Product_ID, Category_name)
values(1,"food_dessert"),
(2,"food_dessert"),
(3,"food_dessert"),
(4,"food_dessert"),
(5,"food_dessert"),
(6,"food_dessert"),
(7,"food_dessert"),
(8,"food_dessert"),
(9,"food_dessert"),
(10,"food_dessert"),
(11,"food_dessert"),
(12,"food_dessert"),
(13,"food_dessert"),

(14,"tea_drink"),
(15,"tea_drink"),
(16,"tea_drink"),
(17,"tea_drink"),
(18,"tea_drink"),
(19,"tea_drink"),
(20,"tea_drink"),
(21,"tea_drink"),

(22,"acc"),
(23,"acc"),

(24,"fruit"),
(25,"fruit"),
(26,"fruit"),
(27,"fruit");
create table Product_Image(
	Image_ID int not null AUTO_INCREMENT,
	Product_ID int not null,
	Image_path VARCHAR(255) not null,
	primary key (Image_ID, Product_ID),
	foreign key (Product_ID) references Product(Product_ID) on update cascade on delete cascade
);


insert into Product_Image(Product_ID, Image_path)
value(1,"./images/food_dessert_images/1.jpg"),
(2,"./images/food_dessert_images/2.jpg"),
(3,"./images/food_dessert_images/3.jpg"),
(4,"./images/food_dessert_images/4.jpg"),
(5,"./images/food_dessert_images/5.jpg"),
(6,"./images/food_dessert_images/6.jpg"),
(7,"./images/food_dessert_images/7.jpg"),
(8,"./images/food_dessert_images/8.jpg"),
(9,"./images/food_dessert_images/9.jpg"),
(10,"./images/food_dessert_images/10.jpg"),
(11,"./images/food_dessert_images/11.jpg"),
(12,"./images/food_dessert_images/12.jpg"),
(13,"./images/food_dessert_images/13.jpg"),

(14,"./images/tea_drink_images/1.jpg"),
(15,"./images/tea_drink_images/2.jpg"),
(16,"./images/tea_drink_images/3.jpg"),
(17,"./images/tea_drink_images/4.jpg"),
(18,"./images/tea_drink_images/5.jpg"),
(19,"./images/tea_drink_images/6.jpg"),
(20,"./images/tea_drink_images/7.jpg"),
(21,"./images/tea_drink_images/8.jpg"),

(22,"./images/acc/1.jpg"),
(23,"./images/acc/2.jpg"),

(24,"./images/fruit/1.jpg"),
(25,"./images/fruit/2.jpg"),
(26,"./images/fruit/3.jpg"),
(27,"./images/fruit/4.jpg");

select * from Product_image;
-- delete from `Product_image` where Product_ID;
-- alter table `Product_image` AUTO_INCREMENT = 1;


create table Coupon(
	Coupon_ID int not null AUTO_INCREMENT,
	Coupon_Name VARCHAR(50) not null,
	DiscountCount INT not null,
	StartDate Datetime not null,
	EndDate Datetime not null,
	primary key (Coupon_ID)
);

create table ShoppingCart(
	Member_ID int not null,
    Product_ID int not null,
	Product_amount INT not null,
	primary key (Member_ID, Product_ID),
	foreign key (Member_ID) references `Member`(Member_ID) on update cascade on delete cascade,
    foreign key (Product_ID) references Product(Product_ID) on update cascade on delete cascade
);

-- to fix the previous primary key for already table ShoppingCart, use:
	-- 	ALTER TABLE ShoppingCart   
	--   DROP PRIMARY KEY,
	--   ADD PRIMARY KEY (Member_ID, Product_ID);

create table `Order`(
	Order_ID int not null AUTO_INCREMENT, 
	Member_ID int not null,
	Coupon_ID int not null,
	Payment_method VARCHAR(20),
	Payment_Date DATETIME,
	Deliver_method VARCHAR(20),
    Deliver_address VARCHAR(100),
	Total_price INT,
	Discounted_price INT,
	Order_date DATETIME,
	Order_status INT not null,
	primary key (Order_ID),
	foreign key (Member_ID) references `Member`(Member_ID) on update cascade On delete cascade,
	foreign key (Coupon_ID) references Coupon(Coupon_ID) on update cascade on delete cascade
);



