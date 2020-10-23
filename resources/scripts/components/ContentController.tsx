import React, { FC, useState } from 'react'
import ControlPanel from './ControlPanel'
import DisplayPanel from './DisplayPanel'

const ContentController: FC = () => {
  const [activeTab, setActiveTab] = useState(0)

  return (
    <>
      <ControlPanel activeLang={activeTab} activateTab={setActiveTab} />
      <hr />

      {!!activeTab && (
        <DisplayPanel activeLang={activeTab} />
      )}
    </>
  )
}

export default ContentController
