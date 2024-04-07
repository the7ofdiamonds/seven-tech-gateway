import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import { getFounders } from '../controllers/founderSlice';

import LoadingComponent from '../loading/LoadingComponent';
import GroupMembers from './components/GroupMembers';

function Founders() {
  const { founderLoading, founderError, founders } = useSelector(
    (state) => state.founder
  );
  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getFounders());
  }, [dispatch]);

  if (founderLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      {Array.isArray(founders) &&
        founders.map((founder) => (
          <>
            <h4 className="title">Founders</h4>

            <GroupMembers key={founder.id} group={founder} />
          </>
        ))}
    </>
  );
}

export default Founders;
