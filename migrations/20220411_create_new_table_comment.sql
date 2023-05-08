CREATE TABLE Comment

(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    text_comment VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    comment_id INT
    created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
);
