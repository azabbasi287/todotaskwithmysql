create table usertask(
    `id` INT(99) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `names` varchar(500)  not null ,
    `task` varchar(500) not null ,
    `create_at` timestamp not null default current_timestamp ,
    `completed` BOOLEAN
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

commit ;