import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

function MemberNavigationComponent(props) {
  const { resume } = props;

  const founderSection = document.getElementById('founder');
  const portfolioElement = document.getElementById('portfolio');
  const portfolioButton = document.getElementById('portfolio_button');
  const founderButton = document.getElementById('founder_button');

  function updateButtonVisibility(currentSectionId) {
    if (currentSectionId === 'founder') {
      founderButton.style.display = 'none';
      portfolioButton.style.display = 'block';
    } else if (currentSectionId === '7tech_portfolio') {
      portfolioButton.style.display = 'none';
      founderButton.style.display = 'block';
    }
  }

  // Button press
  const scrollToSection = (sectionId) => {
    const section = document.getElementById(sectionId);
    console.log(section);
    if (section) {
      const offsetTopPx = section.getBoundingClientRect().top + window.scrollY;
      const paddingTopPx = 137.5;
      const rootFontSize = parseFloat(
        getComputedStyle(document.documentElement).fontSize
      );

      const paddingTopRem = paddingTopPx / 16;
      const paddingTopBackToPx = paddingTopRem * rootFontSize;
      const topPx = offsetTopPx - paddingTopBackToPx;

      window.scrollTo({
        top: topPx,
        behavior: 'smooth',
      });
    }
  };

  const openResumeInNewTab = () => {
    window.location.href = 'resume';
  };

  return (
    <nav class="author-nav">
      <button onClick={scrollToSection('founder')} id="founder_button">
        <h3>FOUNDER</h3>
      </button>

      <button
        onClick={scrollToSection('7tech_portfolio')}
        id="portfolio_button">
        <h3>PORTFOLIO</h3>
      </button>

      {resume ? (
        <button onClick={openResumeInNewTab}>
          <h3>RÉSUMÉ</h3>
        </button>
      ) : (
        ''
      )}
    </nav>
  );
}

export default MemberNavigationComponent;
