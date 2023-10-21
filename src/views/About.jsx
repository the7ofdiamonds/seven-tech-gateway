import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import ContentComponent from '../views/components/ContentComponent';
import HeadquartersComponent from '../views/components/HeadquartersComponent';

import Founders from './Founders';

import { getContent, getHeadquarters } from '../controllers/contentSlice';

function About() {
  const dispatch = useDispatch();

  const missionStatement = 'Turning ideas into tangible assets ';
  const { content, headquarters } = useSelector((state) => state.content);

  useEffect(() => {
    dispatch(getContent('about'));
  }, [dispatch]);

  // useEffect(() => {
  //   dispatch(getHeadquarters());
  // }, [dispatch]);

  return (
    <>
      <section className="about">
        <h2>ABOUT</h2>

        <div class="mission-statement-card card">
          <h4 class="mission-statement">
            <q>{missionStatement}</q>
          </h4>
        </div>

        <ContentComponent content={content} />

        <Founders />
      </section>
    </>
  );
}

export default About;
