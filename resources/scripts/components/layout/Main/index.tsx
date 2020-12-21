import React, { FC, useState } from 'react'
import ControlPanel from '../../ControlPanel'
import RepoList from '../../RepoList'
import './styles.css'

const Main: FC = () => {
  const [activeTab, setActiveTab] = useState(0)

  return (
    <main className="container-fluid content-wrapper">
      <div className="container" role="main">
        <ControlPanel activeLang={activeTab} activateTab={setActiveTab} />
        <hr />

        {!!activeTab && (
          <RepoList activeLang={activeTab} />
        )}
      </div>
    </main>
  )
}

export default Main
