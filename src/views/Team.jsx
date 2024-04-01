import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import { getTeam } from '../controllers/teamSlice';

import LoadingComponent from '../loading/LoadingComponent';
import ErrorComponent from '../error/ErrorComponent';
import GroupMembers from './components/GroupMembers';

function Team() {
  const { teamLoading, teamError, team } = useSelector((state) => state.team);
  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getTeam());
  }, [dispatch]);

  if (teamLoading) {
    return <LoadingComponent />;
  }

  if (teamError) {
    return <ErrorComponent error={teamError} />;
  }

  return (
    <>
      <section className="team">
        <h4 className="title">Team</h4>

        <GroupMembers group={team} />
      </section>
    </>
  );
}

export default Team;
