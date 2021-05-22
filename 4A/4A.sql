/* Tampilkan semua course */
SELECT * FROM course;

/*
    tampilkan course beserta penulis lengkap dengan content nya,
    field ditampilkan
    name course,
    durasi course,
    name author,
    description course,
    thumbnail course
*/
SELECT course.name, duration, author.name, description, thumbnail FROM course
INNER JOIN author IN course.author_id = author.id;

/*
	Tampilan detail course berdasarkan id
	eg: id = 1;
*/
SELECT * FROM content WHERE id_course = 1;

/*
	Tampilkan hasil query post tambah course, content dan author
*/
INSERT INTO course (name, thumbnail, id_author, duration, description) 
VALUES ($name, $thumbnail, $id_author, $duration, $description);

INSERT INTO content (name, video_link, type, id_course)
VALUES ($name, $video_link, $type, $id_course);

INSERT INTO author (name) VALUES ($name);