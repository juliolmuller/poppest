import React from 'react'
import './index.css'

export default function Header() {
  return (
    <header className="bg-pop">
      <div className="container">
        <div className="center-content">
          <div className="row">
            <div className="col-12 intro-text">
              <h1 id="app-title">
                Poppest
              </h1>
              <hr className="star-light" />
              <h2 id="app-subtitle" className="h4 d-none d-md-block">
                The Most Popular Repositories in GitHub
              </h2>
            </div>
          </div>
        </div>
      </div>
    </header>
  )
}
