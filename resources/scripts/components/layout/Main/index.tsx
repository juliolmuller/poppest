import React, { FC } from 'react'
import ContentController from '../../ContentController'
import './index.css'

const Main: FC = () => (
  <main className="container-fluid content-wrapper">
    <div className="container" role="main">
      <ContentController />
    </div>
  </main>
)

export default Main
