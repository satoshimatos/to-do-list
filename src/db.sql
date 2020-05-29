create table todo (
    id serial primary key,
    title varchar(255),
    description text,
    entry_time varchar(100),
    edit_time varchar(100),
    observations text,
    archived char(1),
    edited char(1)
)