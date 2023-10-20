import React from 'react';

function ContentComponent(props) {
  const { content } = props;
  console.log(content);
  return (
    <>
      {content
        ? content.map((paragraph, index) => (
            <div
              key={index}
              className="card"
              dangerouslySetInnerHTML={{ __html: paragraph }}></div>
          ))
        : null}
    </>
  );
}

export default ContentComponent;
