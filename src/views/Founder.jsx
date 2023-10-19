import React, { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getFounder, getFounderResume } from '../controllers/founderSlice';

import LoadingComponent from '../loading/LoadingComponent';
import ErrorComponent from '../error/ErrorComponent';

import MemberNavigationComponent from './components/MemberNavigationComponent';
import MemberProgrammingSkillsComponent from './components/MemberProgrammingSkillsComponent';
import MemberIntroductionComponent from './components/MemberIntroductionComponent';

function Founder() {
  const { founder } = useParams();
  const dispatch = useDispatch();

  // const skills = ['html5', 'css3-alt', 'js', 'php', 'java', 'swift', 'docker'];

  useEffect(() => {
    dispatch(getFounder(founder));
  }, [dispatch, founder]);

  useEffect(() => {
    dispatch(getFounderResume(founder));
  }, [dispatch]);

  const {
    founderLoading,
    founderError,
    title,
    avatarURL,
    fullName,
    greeting,
    skills,
    founderResume,
  } = useSelector((state) => state.founder);

  if (founderLoading) {
    return <LoadingComponent />;
  }

  if (founderError) {
    return <ErrorComponent error={founderError} />;
  }

  return (
    <>
      <MemberNavigationComponent resume={founderResume} />
      <MemberIntroductionComponent
        title={title}
        avatarURL={avatarURL}
        fullName={fullName}
        greeting={greeting}
      />
      <MemberProgrammingSkillsComponent skills={skills} />
    </>
  );
}

export default Founder;
