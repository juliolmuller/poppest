import React, { Component } from 'react'
import ContentController from './../../ContentController'
import './index.css'

export default function Main() {
  return (
    <main className="container-fluid content-wrapper">
      <div className="container" role="main">
        <ContentController />
      </div>
    </main>
  )
}
