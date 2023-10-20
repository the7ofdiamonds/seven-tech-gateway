import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import ContentComponent from '../views/components/ContentComponent';

import { getContent } from '../controllers/contentSlice';

function About() {
  const dispatch = useDispatch();

  const missionStatement = 'Turning ideas into tangible assets ';
  const { content } = useSelector((state) => state.content);

  useEffect(() => {
    dispatch(getContent('about'));
  }, [dispatch]);
console.log(content);
  return (
    <>
      <h2>ABOUT</h2>

      <div class="mission-statement-card card">
        <h4 class="mission-statement">
          <q>{missionStatement}</q>
        </h4>
      </div>

      <ContentComponent content={content} />
    </>
  );
}

export default About;
