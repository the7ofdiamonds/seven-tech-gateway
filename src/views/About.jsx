import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import ContentComponent from '../views/components/ContentComponent';

import Founders from './Founders';

import { getContent } from '../controllers/contentSlice';

function About() {
  // const dispatch = useDispatch();

  const missionStatement = 'Turning ideas into tangible assets ';
  // const { content } = useSelector((state) => state.content);

  // useEffect(() => {
  //   dispatch(getContent('about'));
  // }, [dispatch]);

  return (
    <>
      <section className="about">
        <h2>ABOUT</h2>

        <div className="mission-statement-card card">
          <h3 className="mission-statement">
            <q>{missionStatement}</q>
          </h3>
        </div>

        {/* <ContentComponent content={content} /> */}

        <Founders />
      </section>
    </>
  );
}

export default About;
