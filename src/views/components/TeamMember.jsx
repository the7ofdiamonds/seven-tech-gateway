function TeamMember(props) {
  const { team_member } = props;

  return (
    <>
      {team_member && typeof team_member === 'object' ? (
        <div class="author-card card">
          <div className="author-pic">
            <a href={team_member.author_url}>
              <img src={team_member.avatar_url} alt="" />
            </a>
          </div>

          <div class="author-name">
            <h4 className="title">
              {team_member.first_name} {team_member.last_name}
            </h4>
          </div>

          <div class="author-role">
            <h5>{team_member.role}</h5>
          </div>

          <div class="author-contact">
            <a href={`mailto:${team_member.email}`}>
              <i className="fa fa-envelope fa-fw"></i>
            </a>
          </div>
        </div>
      ) : (
        ''
      )}
    </>
  );
}

export default TeamMember;
