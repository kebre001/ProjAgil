/**
 *
 * Responsive website using AngularJS
 * http://www.script-tutorials.com/responsive-website-using-angularjs/
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Script Tutorials
 * http://www.script-tutorials.com/
 */

'use strict';

// angular.js main app initialization
var app = angular.module('example359', []).
    config(['$routeProvider', function ($routeProvider) {
      $routeProvider.
        when('/', { templateUrl: 'pages/index.html', activetab: 'projects', controller: HomeCtrl }).
        when('/project/:projectId', {
          templateUrl: function (params) { return 'pages/' + params.projectId + '.html'; },
          controller: ProjectCtrl,
          activetab: 'projects'
         
        }).
        when('/privacy', {
          templateUrl: 'privacy.php',
          controller: PrivacyCtrl,
          activetab: 'privacy'
          
        }).
        when('/about', {
          templateUrl: 'pages/about.html',
          controller: AboutCtrl,
          activetab: 'about'
        }).
        otherwise({ redirectTo: '/' });
    }]).run(['$rootScope', '$http', '$browser', '$timeout', "$route", function ($scope, $http, $browser, $timeout, $route) {

        $scope.$on("$routeChangeSuccess", function (scope, next, current) {
          $scope.part = $route.current.activetab;
        });
        
         // onclick event handlers
         
         $scope.showEdit = function () {
          $('.edit').slideToggle();
          $('.chat').slideUp();
		//  $('.invite').slideUp();
		//  $('.scrumboard').slideUp(); 
          $('.contactRow').slideUp();
          $('.newprojRow').slideUp();
          $('.logoutRow').slideUp();
          $('.newPartRow').slideUp();
        };

		$scope.closeEdit = function () {
          $('.edit').slideUp();
        };
         
         $scope.showChat = function () {
          $('.chat').slideToggle();
		//  $('.invite').slideUp();
		//  $('.scrumboard').slideUp(); 
          $('.contactRow').slideUp();
          $('.newprojRow').slideUp();
          $('.logoutRow').slideUp();
          $('.newPartRow').slideUp();
        };

		$scope.closeChat = function () {
          $('.chat').slideUp();
        };
         
		 $scope.showInvite = function () {
		  $('.invite').slideToggle();
		 /* $('.scrumboard').slideUp();*/
          $('.contactRow').slideUp();
          $('.newprojRow').slideUp();
          $('.logoutRow').slideUp();
          $('.newPartRow').slideUp();
        };

		$scope.closeInvite = function () {
          $('.invite').slideUp();
        };
		 
         $scope.showScrumboard = function () {
		  $('.scrumboard').slideToggle();
          $('.contactRow').slideUp();
          $('.newprojRow').slideUp();
          $('.logoutRow').slideUp();
          $('.newPartRow').slideUp();
        };

		$scope.closeScrumboard = function () {
          $('.scrumboard').slideUp();
        };

		$scope.showCreateDoc = function () {
		  $('.createDoc').slideToggle();
		  $('.scrumboard').slideUp();
          $('.contactRow').slideUp();
          $('.newprojRow').slideUp();
          $('.logoutRow').slideUp();
          $('.newPartRow').slideUp();
		}
		
		$scope.closeCreateDoc = function () {
			$('.createDoc').slideUp();
		}
         
        $scope.hideDrops = function () {
          $('.contactRow').slideUp();
          $('.newprojRow').slideUp();
          $('.logoutRow').slideUp();
          $('.newPartRow').slideUp();
        };
        
        
        $scope.showForm = function () {
          $('.contactRow').slideToggle();
          $('.newprojRow').slideUp();
          $('.logoutRow').slideUp();
          $('.newPartRow').slideUp();
        };
        $scope.closeForm = function () {
          $('.contactRow').slideUp();
        };

		$scope.showAddPart = function () {
		  $('.newPartRow').slideToggle();
          $('.newprojRow').slideUp();
          $('.contactRow').slideUp();
          $('.logoutRow').slideUp();
        };
        
        $scope.closeAddPart = function () {
          $('.newPartRow').slideUp();
        };

		$scope.showAddProj = function () {
          $('.newprojRow').slideToggle();
          $('.contactRow').slideUp();
          $('.logoutRow').slideUp();
          $('.newPartRow').slideUp();
        };
        $scope.closeAddProj = function () {
          $('.newprojRow').slideUp();
        };
        
        $scope.showLogout = function () {
          $('.logoutRow').slideToggle();
          $('.contactRow').slideUp();
           $('.newprojRow').slideUp();
           $('.newPartRow').slideUp();
        };
        $scope.closeLogout = function () {
          $('.logoutRow').slideUp();
        };

        // save the 'Contact Us' form
        $scope.save = function () {
          $scope.loaded = true;
          $scope.process = true;
          $http.post('sendemail.php', $scope.message).success(function () {
              $scope.success = true;
              $scope.process = false;
          });
        };
  }]);

app.config(['$locationProvider', function($location) {
    $location.hashPrefix('!');
}]);

