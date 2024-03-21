import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import loginSlice from '../controllers/loginSlice';

function Dashboard() {
  const { profileImage, displayName } = useSelector((loginSlice) => loginSlice);
  const profileImg = profileImage
    ? profileImage
    : localStorage.getItem('profile_image');
  const usersDisplayName = displayName
    ? displayName
    : localStorage.getItem('display_name');

  return (
    <section className="dashboard">
      <h2 className="title">Dashboard</h2>
      <div>
        <div>
          <img src={`${profileImg}`} alt="" />
        </div>
        <span>{usersDisplayName}</span>
      </div>

      <div>
        {/* Change Name */}

        {/* Change Title */}

        {/* Chanage Username */}

        {/* Change Password */}

        {/* Change Phone */}

        {/* Remove Email */}

        {/* Delete Account */}
      </div>
    </section>
  );
}

export default Dashboard;
