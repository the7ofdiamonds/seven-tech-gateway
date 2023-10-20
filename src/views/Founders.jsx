import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import { getFounders } from '../controllers/founderSlice';

import LoadingComponent from '../loading/LoadingComponent';
import ErrorComponent from '../error/ErrorComponent';
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

  if (founderError) {
    return <ErrorComponent error={founderError} />;
  }

  return (
    <>
      <section className="founders">
        <h4 className="title">Founders</h4>

        <GroupMembers group={founders} />
      </section>
    </>
  );
}

export default Founders;
