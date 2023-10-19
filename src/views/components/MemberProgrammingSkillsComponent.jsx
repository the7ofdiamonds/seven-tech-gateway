import React, { useEffect } from 'react';

function MemberProgrammingSkillsComponent(props) {
  const { skills } = props;
  const skillsSlide = document.querySelector('.author-skills-slide');

  useEffect(() => {
    if (skills && skillsSlide) {
      // Calculate the total number of skills
      const totalSkills = skillsSlide.children.length;

      // Duplicate the skill icons for a sliding effect
      for (let i = 0; i < totalSkills; i++) {
        skillsSlide.appendChild(skillsSlide.children[i].cloneNode(true));
      }

      // Set the totalSkills as a CSS variable
      document.documentElement.style.setProperty('--total-skills', totalSkills);
    }
  }, [skills, skillsSlide]);

  return (
    <>
      {Array.isArray(skills) && skills.length > 0 ? (
        <div className="author-skills">
          <div className="author-skills-slide">
            {skills.map((skill, index) => (
              <i
                key={index}
                className={`fa-brands fa-${skill.toLowerCase()}`}></i>
            ))}
          </div>
        </div>
      ) : (
        ''
      )}
    </>
  );
}

export default MemberProgrammingSkillsComponent;
