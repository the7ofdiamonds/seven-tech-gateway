import React, { useEffect, useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import { getTeam } from '../controllers/teamSlice';

import TeamMember from './components/TeamMember';

function Team() {
  const { loading, error, team } = useSelector((state) => state.team);
  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getTeam());
  }, [dispatch]);

  return (
    <>
      <h4 className="title">Team</h4>
      <div className="team">
        {Array.isArray(team) && team.length > 0
          ? team.map((team_member) => (
              <>
                <TeamMember team_member={team_member} />
              </>
            ))
          : ''}
      </div>
    </>
  );
}

export default Team;
