INSERT INTO `entries`(`primary_key`, `foreign_key`, `type`, `author`, `category`, `content`, `contributor`, `control`, `edited`, `id`, `link`, `published`, `rights`, `source`, `summary`, `text`, `title`, `updated`) VALUES (:primaryKey, :foreignKey, :type, :author, :category, :content, :contributor, :control, :edited, :id, :link, :published, :rights, :source, :summary, :text, :title, :updated);

UPDATE `entries` SET 
    `foreign_key`=:foreignKey,
    `type`=:type,
    `author`=:author,
    `category`=:category,
    `content`=:content,
    `contributor`=:contributor,
    `control`=:control,
    `edited`=:edited,
    `id`=:id,
    `link`=:link,
    `published`=:published,
    `rights`=:rights,
    `source`=:source,
    `summary`=:summary,
    `text`=:text,
    `title`=:title,
    `updated`=:updated 
WHERE `primary_key`=:primaryKey