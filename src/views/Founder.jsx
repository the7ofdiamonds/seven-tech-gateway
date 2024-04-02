import React, { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getFounder } from '../controllers/founderSlice.js';

import LoadingComponent from '../loading/LoadingComponent';

import MemberNavigationComponent from './components/MemberNavigationComponent';
import MemberProgrammingSkillsComponent from './components/MemberProgrammingSkillsComponent';
import MemberIntroductionComponent from './components/MemberIntroductionComponent';

import FounderSocialComponent from './components/FounderSocialComponent.jsx';

function Founder() {
  const { founder } = useParams();
  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getFounder(founder));
  }, [dispatch, founder]);

  const {
    founderLoading,
    founderError,
    title,
    avatarURL,
    fullName,
    greeting,
    skills,
    founder_resume,
    social_networks
  } = useSelector((state) => state.founder);

  if (founderLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      <section className="founder">
        <MemberNavigationComponent resume={founder_resume} />

        <main className="founder">
          <MemberIntroductionComponent
            title={title}
            avatarURL={avatarURL}
            fullName={fullName}
            greeting={greeting}
          />
        </main>

        <MemberProgrammingSkillsComponent skills={skills} />

        <FounderSocialComponent social_networks={social_networks}/>
      </section>
    </>
  );
}

export default Founder;
